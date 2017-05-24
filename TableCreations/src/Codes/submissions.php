<?php
  include('config.php');
  session_start();
  $myusername = $_SESSION['myusername'];
  $mypassword = $_SESSION['mypassword'];
  $myuser_id = $_SESSION['myuser_id'];


  echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1><a href='company_home.php'>RecruiDB</a></h1></div>";
  echo "<div id='second-div' style='text-align:right;width:50%'><a href=developer_profile.php?user={$myuser_id}><img src='./dev_profile.png' style='height:64;width:64'></a><a href=dev_stats.php><img src='./dev_stats.png' style='height:64;width:64'></a><a href=messages.php?userid={$myuser_id}><img src='./messages.png' style='height:64;width:64'></a></div></div>";

  $chid = $_GET['chid'];
  $challengeq = "SELECT * FROM Challenge where challenge_id = ".$chid;
  $result = $db->query($challengeq);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $challengename = $row['name'];

  echo "<hr/><h2>{$challengename}</h2><hr/>";

  echo "<div id=leaderboard><h2>Leaderboard</h2><div class='datagrid'><table><thead><tr><th>Name</th><th>Challenge Score</th></tr></thead><tbody>";

  $leaderquery = "SELECT u.username, s.user_id, sum(s.sub_score) AS 'scor' FROM User u, Submission s, Question q WHERE u.user_id = s.user_id AND s.question_id = q.question_id AND q.challenge_id = '$chid' GROUP BY user_id HAVING scor BETWEEN 100 AND 10000 ";
  $resultleader = $db->query($leaderquery);
  while($row = $resultleader->fetch_assoc()) {
    echo "<tr> <td>" . $row["username"]. "</td><td>" . $row["scor"]. "</td></tr>";

  }


  echo "</tbody></table></div></div>&nbsp;&nbsp;<hr/><hr/>";
  echo "<div id=submissions>
    <h2>Submissions</h2>
    <div class='datagrid'><table><thead><tr><th>Owner</th><th>Question</th><th>Score</th></tr></thead><tbody>";
  $challengeq = "SELECT * FROM Submission NATURAL JOIN Question where challenge_id = ".$chid;
  $result = $db->query($challengeq);

  while($row = $result->fetch_assoc()) {
    $sql2 = "SELECT * FROM User WHERE user_id = ".$row["user_id"];
    $result2 = $db->query($sql2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    echo "<tr> <td>" . $row2["username"]. "</td><td>" . $row["title"]. "</td><td>" . $row["sub_score"]. "</td></tr>";
  }

  echo "</tbody></table></div></div>";
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



</html>
