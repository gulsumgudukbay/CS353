<?php

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

<h2>Nameless Challenge</h2>
<hr/><hr/>

<div id=leaderboard>
  <h2>Leaderboard</h2>
  <div class="datagrid"><table>
    <thead><tr><th>Name</th><th>Score</th></tr></thead>
    <tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
    <tbody><tr><td>Ahmet Yılmaz</td><td>13</td></tr>
      <tr class="alt"><td>Hamed Abdelhemmad</td><td>25</td></tr>
      <tr><td>Mutlu Güneş</td><td>54</td></tr>
      <tr class="alt"><td>Caner Yıldırım</td><td>29</td></tr>
      <tr><td>Cem Yılmaz</td><td>19</td></tr>
    </tbody>
    </table>
  </div>
</div>

&nbsp;
&nbsp;
<hr/><hr/>

<div id=submissions>
  <h2>Submissions</h2>
  <div id="ch1" style="background-color:#11BB11;width:500px">
    <h3>Hamed Abdelhemmad, Question #3</h3>
    <h4>Answer:</h4>
    <p2>SELECT EMP_ID, LAST_NAME FROM EMPLOYEE_TBL WHERE CITY = 'INDIANAPOLIS' ORDER BY EMP_ID;</p2>
    <hr/><hr/>
  </div>

  <div id="ch1" style="background-color:#11BB11;width:500px">
    <h3>Mutlu Güneş, Question #4</h3>
    <h4>Answer:</h4>
    <p2>SELECT EMP_ID FROM EMPLOYEE_TBL WHERE CITY = 'INDIANAPOLIS' ORDER BY EMP_ID;</p2>
    <hr/><hr/>
  </div>

  <div id="ch1" style="background-color:#BB1111;width:500px">
    <h3>Caner Yıldırım, Question #1</h3>
    <h4>Answer:</h4>
    <p2>SELECT LAST_NAME FROM EMPLOYEE_TBL WHERE CITY = 'INDIANAPOLIS' ORDER BY EMP_ID;</p2>
    <hr/><hr/>
  </div>
</div>
</html>
