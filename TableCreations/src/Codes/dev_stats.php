<?php
include('config.php');
session_start();
$myusername = $_SESSION['myusername'];
$mypassword = $_SESSION['mypassword'];
$myuser_id = $_SESSION['myuser_id'];

$developer_top_bar =
'
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<div class="bucenter">
  <div id="first-div" style="text-align:left;width:50%">
    <h1>RecruiDB</h1>
  </div>
  <div id="second-div" style="text-align:right;width:50%">
    <a href="developer_profile.php?user='.$myuser_id.'"><img src="./dev_profile.png" style="height:64;width:64"></img></a>
    <a href="dev_stats.php"><img src="./dev_stats.png" style="height:64;width:64"></img></a>
    <a href="messages.php?userid='.$myuser_id.'"><img src="./messages.png" style="height:64;width:64"></img></a>
  </div>
</div>
<hr/>
';

echo $developer_top_bar;

echo '<h3>Challenges Solved</h3>';
$sql = "SELECT c.name, count(*), sum(s.sub_score)
        FROM Challenge AS c, Submission AS s, Question AS q
        WHERE c.challenge_id = q.challenge_id
        AND s.question_id = q.question_id
        GROUP BY c.name";
$result = $db->query($sql);

echo "<div class='datagrid'><table>";
echo "<thead><tr><th>Challenge Name</th><th>Submission Count</th><th>Total Score</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
  echo "<tr><td>". $row['name']."</td><td>" .$row['count(*)']. "</td><td>" .$row['sum(s.sub_score)']. "</td></tr>";
}
echo "</tbody></table></div><br></br>";

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



</html>
