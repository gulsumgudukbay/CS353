<?php

  include('config.php');
  session_start();

  $chid = $_GET['chid'];
  $challengeq = "SELECT * FROM Challenge where challenge_id = ".$chid;
  $result = $db->query($challengeq);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $challengename = $row['name'];

  $sql = "SELECT * FROM ChallengePosition NATURAL JOIN Position2 WHERE challenge_id = ".$chid;
  $resultsql = $db->query($sql);
  $rowsql = mysqli_fetch_array($resultsql, MYSQLI_ASSOC);
  $positionname = $rowsql['p_name'];

  echo "<div class='bucenter'>
    <div id='first-div' style='text-align:left;width:50%'>
      <h1>RecruiDB</h1>
    </div>
    <div id='second-div' style='text-align:right;width:50%'>
      <img src='./dev_profile.png' style='height:64;width:64'><img>
      <img src='./dev_stats.png' style='height:64;width:64'><img>
      <img src='./messages.png' style='height:64;width:64'><img>
    </div>
    </div>
    <hr/>

  <div id='new_question'><h2>".$challengename."</h2>";
    echo "<h3>Position: <i>{$positionname}</i></h3>
    <p><i>In this challenge you will answer questions for our {$positionname} opening.</i></p>";

    echo "<div class='datagrid'><table>";
    echo "<thead><tr><th>Question Title</th><th>Difficulty</th><th>Solve!</th></tr></thead>";

    echo "<tbody>";

    $sql = "SELECT * FROM Question WHERE challenge_id = ".$chid;
    $result = $db->query($sql);
    while($row = $result->fetch_assoc()) {
      echo "<tr> <td>" . $row["title"]. "</td><td>" . $row["difficulty"]. "</td><td><a href='solve_question.php?qid={$row['question_id']}'>Solve!</a></td></tr>";
    }

    echo "</tbody></table></div><br></br><br></br><p>&nbsp;</p><h3>Comments:</h3>";


?>

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

  <p><input type"text"/><input type="submit" value="Write Comment"/></p>
  <p><b>Mohammad Abrahimi:</b></p>
  <p>This so hard I cannot solve please help I am want this position so much</p>
  <p><input type"text"/><input type="submit" value="Reply"/></p>
  <p><b>&emsp;|Will Sawyer:</b></p>
  <p>&emsp;|You should try your best. Good Luck!</p>
  <p>&emsp;|<input type"text"/><input type="submit" value="Reply"/></p>


</div>
