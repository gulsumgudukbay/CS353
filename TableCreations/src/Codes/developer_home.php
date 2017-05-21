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

echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1>RecruiDB</h1></div>";
echo "<div id='second-div' style='text-align:right;width:50%'><img src='./dev_profile.png' style='height:64;width:64'><img><img src='./dev_stats.png' style='height:64;width:64'><img><img src='./messages.png' style='height:64;width:64'><img></div></div>";

echo "<hr/>";
echo "<h1>Welcome, {$myuser_name}!</h1>";

echo "<h2>Job Challenges</h2>";
echo "<div class='datagrid'><table>";
echo  "<thead><tr><th>Job Title</th><th>Company</th><th>Challenge Name</th><th>Deadline</th></tr></thead>";
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

  echo "<tr> <td>" . $row2["p_name"]. "</td><td>" . $row3["user_name"]. "</td><td>" . $row["name"]. "</td><td>" . $row["deadline"]."</td>";
}

echo "</tbody></table></div><p><br></p>";

echo "<h2>Practice Questions</h2>";
echo "<div class='datagrid'><table>";
echo "<thead><tr><th>Question Name</th><th>Challenge</th><th>Submissions</th></tr></thead>";

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

  echo "<tr> <td>" . $row["title"]. "</td><td>" . $row2["name"]. "</td><td>" . intval($row3["cnt"]). "</td>";
}

echo "</tbody></table></div>";

$jobsearch = mysqli_real_escape_string($db,$_POST['jobtitle']);
$companysearch = mysqli_real_escape_string($db,$_POST['company_name']);
$devsearch = mysqli_real_escape_string($db,$_POST['devusername']);


echo "<p><br></p>";

echo "<h2>Job Search Results For {$jobsearch}: </h2>";
echo "<div class='datagrid'><table>";
echo "<thead><tr><th></th><th>Challenge Name</th><th>Company Name</th></tr></thead>";

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

  echo "<tr> <td>" . $row["title"]. "</td><td>" . $row2["name"]. "</td><td>" . intval($row3["cnt"]). "</td>";
}

echo "</tbody></table></div>";



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


<div align = "left">
  <div style = "border: solid 1px #333333; " align = "left">
    <div style = "margin:30px">
      <form onsubmit="return validateForm()" action = "" method = "post" name="jobsearch" id="Form">
        <label class = "myp" >Job Search: </label><input type = "text" name = "jobtitle" class = "box"/><br /><br />
        <input type = "submit" value = " Job Search "/><br />
      </form>
      <script type="text/javascript">
      function validateForm(){
        var jt=document.forms["jobsearch"]["jobtitle"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>
    <div style = "margin:30px">
      <form onsubmit="return validateForm()" action = "" method = "post" name="companysearch" id="Form">
        <label class = "myp" >Company Search: </label><input type = "text" name = "company_name" class = "box"/><br /><br />
        <input type = "submit" value = " Company Search "/><br />
      </form>
      <script type="text/javascript">
      function validateForm(){
        var jt=document.forms["companysearch"]["company_name"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>
    <div style = "margin:30px">
      <form onsubmit="return validateForm()" action = "" method = "post" name="devsearch" id="Form">
        <label class = "myp" >Developer Search: </label><input type = "text" name = "devusername" class = "box"/><br /><br />
        <input type = "submit" value = " Developer Search "/><br />
      </form>
      <script type="text/javascript">
      function validateForm(){
        var jt=document.forms["devsearch"]["devusername"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>
  </div>
</div>


</html>
