<?php

  include('config.php');
  session_start();

  $chid = $_GET['chid'];
  echo "HELLO ".$chid;
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
<div class="bucenter">
  <div id="first-div" style="text-align:left;width:50%">
    <h1>RecruiDB</h1>
  </div>

  <div id="second-div" style="text-align:right;width:50%">
    <img src="./dev_profile.png" style="height:64;width:64"><img>
    <img src="./dev_stats.png" style="height:64;width:64"><img>
    <img src="./messages.png" style="height:64;width:64"><img>
  </div>

</div>
<hr/>

<div id="new_question">
  <h2>Microsoft Algo Challenge</h2>
  <h3>Position: <i>Low-level Optimization Engineer</i></h3>
  <p><i>In this challenge you will answer questions for our Low-level Optimization Engineer opening.</i></p>

  <div id="ch1" style="background-color:#44BB44;width:500px">
    <h3>Find the Dünya Lideri</h3>
    <p2>Find Dünya lideri in O(logn) time.</p2>
    <hr/><hr/>
  </div>

  <div id="ch2" style="background-color:#44BB44;width:500px">
    <h3>Catch them all</h3>
    <p2>Locate all enemies.</p2>
    <hr/><hr/>
  </div>

  <div id="ch3" style="background-color:#BBBBBB;width:500px">
    <h3>Follow the rabbit</h3>
    <p2>Where does he hide?</p2>
  <hr/><hr/>
  </div>

  <p>&nbsp;</p>

  <h3>Comments:</h3>
  <p><input type"text"/><input type="submit" value="Write Comment"/></p>
  <p><b>Mohammad Abrahimi:</b></p>
  <p>This so hard I cannot solve please help I am want this position so much</p>
  <p><input type"text"/><input type="submit" value="Reply"/></p>
  <p><b>&emsp;|Will Sawyer:</b></p>
  <p>&emsp;|You should try your best. Good Luck!</p>
  <p>&emsp;|<input type"text"/><input type="submit" value="Reply"/></p>


</div>
