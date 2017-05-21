<?php

  include('config.php');
  session_start();
  $myuser_id = $_SESSION['myuser_id'];
  $userid = $_GET['userid'];

  $_SESSION[myuser_id] = intval($userid);

  echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1><a href='developer_home.php'>RecruiDB</a></h1></div>";
  echo "<div id='second-div' style='text-align:right;width:50%'><a href=developer_profile.php?user={$myuser_id}><img src='./dev_profile.png' style='height:64;width:64'></a><a href=dev_stats.php><img src='./dev_stats.png' style='height:64;width:64'></a><a href=messages.php?userid={$myuser_id}><img src='./messages.png' style='height:64;width:64'></a></div></div>";

  //MESSAGE DELETE
  if(isset($_GET["delete"])){

    $getURI = $_GET["delete"];
    $getURI = intval($getURI);

    $deletequery = "DELETE FROM Message WHERE msg_id=".$getURI;
    $deletequeryresult = mysqli_query($db, $deletequery);

    if($deletequeryresult) echo "The message is deleted successfully!";
    else echo "The message cannot be deleted!";

  }


  echo "<h2>Inbox</h2>";
  echo "<div class='datagrid'><table>";
  echo "<thead><tr><th>From</th><th>Message Text</th><th>Message Date</th><th>Delete Message</th></tr></thead>";

  echo "<tbody>";

  $sql = "SELECT * FROM Message, User WHERE Message.from_id = User.user_id AND to_id = ".$userid;
  $result = $db->query($sql);
  while($row = $result->fetch_assoc()) {
    echo "<tr> <td>" . $row["email"]. "</td><td>" . $row["text"]. "</td><td>{$row['msg_date']}</td><td><a href = 'messages.php?userid={$userid}&delete={$row['msg_id']}'><input id='delbtn' type='submit' value='Delete'/></a></td></tr>";
  }

  echo "</tbody></table></div><br></br>";


  echo "<h2>Outbox</h2>";
  echo "<div class='datagrid'><table>";
  echo "<thead><tr><th>To</th><th>Message Text</th><th>Message Date</th><th>Delete Message</th></tr></thead>";

  echo "<tbody>";

  $sql = "SELECT * FROM Message, User WHERE Message.to_id = User.user_id AND from_id = ".$userid;
  $result = $db->query($sql);
  while($row = $result->fetch_assoc()) {
    echo "<tr> <td>" . $row["email"]. "</td><td>" . $row["text"]. "</td><td>{$row['msg_date']}</td><td><a href = 'messages.php?userid={$userid}&delete={$row['msg_id']}'><input id='delbtn' type='submit' value='Delete'/></a></td></tr>";
  }

  echo "</tbody></table></div><br></br>";


  if($_SERVER["REQUEST_METHOD"] == "POST") {
//| msg_id | text              | msg_date            | to_id | from_id |

    if( isset($_POST['sendmsg'])) {

      $msgemail = mysqli_real_escape_string($db,$_POST['toemail']);
      $msgtext = mysqli_real_escape_string($db,$_POST['msgtext']);
      echo $msgemail." ".$msgtext;
      $uidquery = "SELECT * FROM User WHERE User.email LIKE '".$msgemail."';";
      $uidresult = $db->query($uidquery);
      $uidrow = mysqli_fetch_array($uidresult);

      $qquery = "INSERT INTO Message VALUES(NULL, '$msgtext', NOW(), ".$uidrow['user_id'].", ".$userid.")";
      $result = $db->query($qquery);
      if($result) echo "Message sent successfully!";
      else echo "Message cannot be sent!";
    }
  }

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

<div style = "border: solid 1px #333333; " align = "left">
  <div style = "margin:30px">
    <form onsubmit="return validateForm1()" action = "" method = "post" name="newmessage" id="jobsearch">
      <label class = "myp" >To Email: </label><input type = "text" name = "toemail" class = "box"/><br />
      <label class = "myp" >Message Text: </label><input style="height:200px;width:300px;" type = "text" name = "msgtext" class = "box"/><br /><br />
      <input type = "submit" value = " Send Message "name="sendmsg"/><br />
    </form>
    <script type="text/javascript">
    function validateForm1(){
      var te=document.forms["newmessage"]["toemail"].value;
      var mt=document.forms["newmessage"]["msgtext"].value;

      if ((te==null || te=="") || (mt==null || mt=="")){
        alert("Please fill the required fields!");
        return false;
      }
    }
    </script>
  </div>

  <p><br></p>

</div>
