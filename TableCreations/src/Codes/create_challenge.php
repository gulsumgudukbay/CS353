<?php

include('config.php');
session_start();
$myusername = $_SESSION['myusername'];
$mypassword = $_SESSION['mypassword'];
$myuser_id = $_SESSION['myuser_id'];

$sql = "SELECT * FROM Company WHERE user_id = $myuser_id";
$result = mysqli_query($db,$sql);
$row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
$myuser_name = $row1["company_name"];
echo "<h1>Welcome, {$myuser_name}!</h1>";
echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1>RecruiDB</h1></div>";
echo "<div id='second-div' style='text-align:right;width:50%'><img src='./dev_profile.png' style='height:64;width:64'><img><img src='./dev_stats.png' style='height:64;width:64'><img><img src='./messages.png' style='height:64;width:64'><img></div></div>";
echo "<h2>New Challenge</h2><hr/>";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $challengetitle = mysqli_real_escape_string($db,$_POST['challengetitle']);
  $jobtitle = mysqli_real_escape_string($db,$_POST['jobtitle']);
  $challengetopic = mysqli_real_escape_string($db,$_POST['challengetopic']);
  $challengedeadline = mysqli_real_escape_string($db,$_POST['challengedeadline']);

  $insertChalengeQuery = "INSERT INTO Challenge VALUES (NULL, '$challengetitle', '$challengedeadline', '$challengetopic', 1)";
  $insertchallengeresult = mysqli_query($db, $insertChalengeQuery);
  $lastinsertid = mysql_insert_id();
  if($insertchallengeresult == TRUE) echo "inserted!";
  else echo "error";
  $searchJobTitle = "SELECT * FROM Position2 WHERE p_name = ".$jobtitle;
  $searchJobTitleResult = mysqli_query($db, $searchJobTitle);
  $count = mysqli_num_rows($searchJobTitleResult);

  if($count <= 0){
    $insertPositionQuery = "INSERT INTO Position2 VALUES (NULL, $jobtitle, $myuser_id)";
    $insertPositionResult = mysqli_query($db, $insertPositionQuery);
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


<div align = "left">
  <div style = "border: solid 1px #333333; " align = "left">

    <div style = "margin:30px">

      <form onsubmit="return validateForm()" action = "" method = "post" name="Form" id="Form">
        <label class = "myp" >Challenge Title: </label><input type = "text" name = "challengetitle" class = "box"/><br /><br />
        <label class = "myp" >Job Title: </label><input type = "text" name = "jobtitle" class = "box" /><br/><br />
        <label class = "myp" >Challenge Topic: </label><input type = "text" name = "challengetopic" class = "box" /><br/><br />
        <label class = "myp" >Challenge Deadline: </label><input type = "text" name = "challengedeadline" class = "box" /><br/><br />
        <label class = "myp" >Challenge Definition: </label><input type = "text" name = "challengedefinition" class = "box" /><br/><br />


        <input type = "submit" value = " Create Challenge "/><br />
      </form>

      <script type="text/javascript">
      function validateForm(){
        var ct=document.forms["Form"]["challengetitle"].value;
        var jt=document.forms["Form"]["jobtitle"].value;
        var ctop=document.forms["Form"]["challengetopic"].value;
        var cd=document.forms["Form"]["challengedeadline"].value;
        var cdef=document.forms["Form"]["challengedefinition"].value;

        if ((ct==null || ct=="") || (jt==null || jt=="") || (ctop==null || ctop=="") || (cdef==null || cdef=="")){
          alert("Please fill the required fields!");
          return false;
        }
      }
      </script>

    </div>
  </div>

</div>


</html>
