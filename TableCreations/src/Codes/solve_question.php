<?php

  include('config.php');
  session_start();
  $myuser_id = $_SESSION['myuser_id'];
  $qid = $_GET['qid'];

  $qquery = "SELECT * FROM Question where question_id = ".$qid;
  $result = $db->query($qquery);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $qname = $row['title'];

  echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1>RecruiDB</h1></div>";
  echo "<div id='second-div' style='text-align:right;width:50%'><a href=developer_profile.php?user={$myuser_id}><img src='./dev_profile.png' style='height:64;width:64'></a><a href=dev_stats.php><img src='./dev_stats.png' style='height:64;width:64'></a><a href=messages.php?userid={$myuser_id}><img src='./messages.png' style='height:64;width:64'></a></div></div>";
  echo "<div id='solve'>
    <h2>{$qname}</h2>
    <p>Query all columns for all American cities in CITY with populations larger than 100000. The CountryCode for America is USA.</p>
    <h3>Answer</h3>";

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $qquery = "INSERT INTO Submission VALUES(NULL, NOW(), $myuser_id, $qid, FLOOR(RAND()*100))";
    $result = $db->query($qquery);
    if($result) echo "Submission added successfully!";
    else echo "Submission cannot be made!";
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

  <div style = "border: solid 1px #333333; " align = "left">
    <div style = "margin:30px">
      <form onsubmit="return validateForm1()" action = "" method = "post" name="solve" id="jobsearch">
        <label class = "myp" ></label><input style="height:200px;width:300px;" type = "text" name = "answer" class = "box"/><br /><br />
        <input type = "submit" value = " Submit Answer "name="submitanswer"/><br />
      </form>
      <script type="text/javascript">
      function validateForm1(){
        var jt=document.forms["solve"]["answer"].value;

        if ((jt==null || jt=="")){
          alert("Please fill the required field!");
          return false;
        }
      }
      </script>
    </div>

    <p><br></p>

  </div>


</html>
