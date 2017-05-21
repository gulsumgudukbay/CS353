<?php
include('config.php');
session_start();
$myusername = $_SESSION['myusername'];
$mypassword = $_SESSION['mypassword'];
$myuser_id = $_SESSION['myuser_id'];

$sql = "SELECT * FROM User WHERE user_id = $myuser_id";
$result = mysqli_query($db,$sql);
$row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
$myuser_name = $row1["user_name"];
echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1><a href='index.php'>RecruiDB</a></h1></div>";
echo "<div id='second-div' style='text-align:right;width:50%'><a href=developer_profile.php?user={$myuser_id}><img src='./dev_profile.png' style='height:64;width:64'></a><a href=dev_stats.php><img src='./dev_stats.png' style='height:64;width:64'></a><a href=messages.php?userid={$myuser_id}><img src='./messages.png' style='height:64;width:64'></a></div></div>";
echo "<hr/><br/><h1>Welcome, {$myuser_name}!</h1>";
echo "<h2>Job Challenges</h2>";
echo "<div class='datagrid'><table>";
echo  "<thead><tr><th>Job Title</th><th>Company</th><th>Challenge Name</th><th>Deadline</th><th>Go To Challenge!</th></tr></thead>";
echo "<tbody>";

$sql = "SELECT Challenge.challenge_id, Position2.user_id, Challenge.name, Challenge.deadline, Position2.ident FROM Challenge, ChallengePosition, Position2 WHERE ChallengePosition.challenge_id = Challenge.challenge_id AND ChallengePosition.ident = Position2.ident";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $sql2 = "SELECT p_name FROM Position2 WHERE user_id =".$row["user_id"];
  $result2 = $db->query($sql2);
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

  $sql3 = "SELECT user_name FROM User WHERE user_id =".$row["user_id"];
  $result3 = $db->query($sql3);
  $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

  echo "<tr><td>" . $row2["p_name"]. "</td><td>" . $row3["user_name"]. "</td><td>" . $row["name"]. "</td><td>" . $row["deadline"]."</td><td><a href='challenge_page.php?chid={$row['challenge_id']}'>CLICK</a></td></tr>";
}

echo "</tbody></table></div><p><br></p>";

echo "<h2>Practice Questions</h2>";
echo "<div class='datagrid'><table>";
echo "<thead><tr><th>Question Name</th><th>Challenge</th><th>Submissions</th><th>Go To Challenge!</th></tr></thead>";

echo "<tbody>";

$sql = "SELECT Question.challenge_id, Question.question_id, Question.title FROM Question";
$result = $db->query($sql);
while($row = $result->fetch_assoc()) {
  $sql2 = "SELECT Challenge.name, Challenge.challenge_id FROM Challenge WHERE Challenge.challenge_id=".$row["challenge_id"];
  $result2 = $db->query($sql2);
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

  $sql3 = "SELECT question_id, count(*) AS 'cnt' FROM Submission WHERE question_id=".$row["question_id"]." GROUP BY question_id";
  $result3 = $db->query($sql3);
  $row3 = mysqli_fetch_assoc($result3);

  echo "<tr> <td>" . $row["title"]. "</td><td>" . $row2["name"]. "</td><td>" . intval($row3["cnt"]). "</td><td><a href='challenge_page.php?chid={$row['challenge_id']}'>CLICK</a></td></tr>";
}

echo "</tbody></table></div><br></br>";

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $jobsearch = mysqli_real_escape_string($db,$_POST['jobtitle']);
  $companysearch = mysqli_real_escape_string($db,$_POST['company_name']);
  $devsearch = mysqli_real_escape_string($db,$_POST['devusername']);
  if (isset($_POST['jobsearch'])) {


    echo "<h2>Job Search Results For {$jobsearch}: </h2>";

    //list the challenges and company names of the challenges for position search
    $selectquery = "SELECT * FROM Position2 WHERE p_name LIKE '%".$jobsearch."%'";
    $result = mysqli_query($db, $selectquery);
    $resultselect = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $identt = intval($resultselect["ident"]);

    $sql = "SELECT * FROM ChallengePosition NATURAL JOIN Challenge where ChallengePosition.ident = ".$identt;
    $result = $db->query($sql);
    $count1 = mysqli_num_rows($result);
    if ($count1 >= 1) {
      echo "<div class='datagrid'><table>";
      echo "<thead><tr><th>Position</th><th>Challenge Name</th><th>Company Name</th><th>Go To Challenge!</th></tr></thead>";

      echo "<tbody>";
      while($row = $result->fetch_assoc()) {
        $sql2 = "SELECT * FROM Position2 NATURAL JOIN ChallengePosition WHERE ChallengePosition.ident=".$identt;
        $result2 = $db->query($sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

        $sql3 = "SELECT company_name FROM Company WHERE user_id =".$row2['user_id'];
        $result3 = $db->query($sql3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

        echo "<tr> <td>" . $row2["p_name"]. "</td><td>" . $row["name"]. "</td><td>" . $row3["company_name"]. "</td><td><a href='challenge_page.php?chid={$row['challenge_id']}'>CLICK</a></td></tr>";
      }

      echo "</tbody></table></div>";
    }
    else{
      echo "Position does not exist.";
    }
    echo "<br></br><br></br>";

  }

  if (isset($_POST['companysearch'])) {
    echo "<p><br></p>";

    echo "<h2>Company Search Results For {$companysearch}: </h2>";

    $sqlcomp = "SELECT * FROM Company WHERE company_name LIKE '%".$companysearch."%'";
    $resultcomp =$db->query($sqlcomp);
    $count = mysqli_num_rows($resultcomp);
    if ($count >= 1) {
      echo "<div class='datagrid'><table><thead><tr><th>Company Name</th><th>Go To Company Page!</th></tr></thead><tbody>";

      while($resultcompp = $resultcomp->fetch_assoc()){
        echo "<tr> <td>".$resultcompp["company_name"]."</td><td><a href='company_info.php?compid={$resultcompp['user_id']}'>Company Page</a></td></tr>";
      }
      echo "</tbody></table></div>";

    }
    else {
      echo "Company does not exist!";
    }
    echo "<br></br><br></br>";

  }

  if (isset($_POST['devsearch'])) {

    echo "<h2>Developer Search Results For {$devsearch}: </h2>";

    $sqldev = "SELECT * FROM User WHERE username LIKE '%".$devsearch."%'";
    $resultdev= $db->query($sqldev);
    $devcount = mysqli_num_rows($resultdev);

    if ($devcount >= 1) { //user found
      $index = 0;
      while($resultdevv = $resultdev->fetch_assoc()){
        $sqldev2 = "SELECT * FROM Developer WHERE user_id=".$resultdevv["user_id"];
        $resultdev2= $db->query($sqldev2);;
        $count2 = mysqli_num_rows($resultdev2);

        if($count2 >= 1 ){ //user found and is a developer
          if($index == 0)
            echo "<div class='datagrid'><table><thead><tr><th>Developer Username</th><th>Go To Developer Profile Page!</th></tr></thead><tbody>";
          while($resultdevv2 = $resultdev2->fetch_assoc()){
            echo "<tr> <td>".$resultdevv["username"]."</td><td><a href='developer_profile.php?user={$resultdevv2['user_id']}'>Profile Page</a></td></tr>";
          }
          $index = $index + 1;

          if($index+1 == $count2)
            echo "</tbody></table></div><br></br>";

        }
        else { echo "The username or username part does not belong to a developer!<br></br>";}

      }
    }
    else {
      echo "Developer does not exist!<br></br>";
    }

  }



}

?>
<html>

<style>
body
{
  font-family: Helvetica;
}

.myp
{
  text-align: right;
}

.bucenter {
  display: flex;
  justify-content: center; /* center items vertically, in this case */
  align-items: center;
}

.bucont {
  display: flex;
}

.busag {
  display: flex;
  justify-content: right; /* center items vertically, in this case */
  align-items: right;
}

.busol {
  display: flex;
  justify-content: left; /* center items vertically, in this case */
  align-items: left;
}

.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEf4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>


<div align = "left" style = "position: fixed;bottom: 0;width: 100%;" >
  <p><br></p>

  <div style = "border: solid 1px #333333; " align = "left">
    <div style = "margin:30px">
      <form onsubmit="return validateForm1()" action = "" method = "post" name="jobsearch" id="jobsearch">
        <label class = "myp" >Job Search: </label><input type = "text" name = "jobtitle" class = "box"/><br /><br />
        <input type = "submit" value = " Job Search "name="jobsearch"/><br />
      </form>
      <script type="text/javascript">
      function validateForm1(){
        var jt=document.forms["jobsearch"]["jobtitle"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      function DoNav(theUrl)
      {
        document.location.href = theUrl;
      }
      </script>
    </div>
    <div style = "margin:30px">
      <form onsubmit="return validateForm2()" action = "" method = "post" name="companysearch" id="companysearch">
        <label class = "myp" >Company Search: </label><input type = "text" name = "company_name" class = "box"/><br /><br />
        <input type = "submit" value = " Company Search " name="companysearch"/><br />
      </form>
      <script type="text/javascript">
      function validateForm2(){
        var jt=document.forms["companysearch"]["company_name"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>
    <div style = "margin:30px">
      <form onsubmit="return validateForm3()" action = "" method = "post" name="devsearch" id="devsearch">
        <label class = "myp" >Developer Search: </label><input type = "text" name = "devusername" class = "box"/><br /><br />
        <input type = "submit" value = " Developer Search "name="devsearch"/><br />
      </form>
      <script type="text/javascript">
      function validateForm3(){
        var jt=document.forms["devsearch"]["devusername"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>
    <p><br></p>

  </div>
</div>


</html>
