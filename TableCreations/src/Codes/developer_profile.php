<?php
  include('config.php');
  session_start();
  $myusername = $_SESSION['myusername'];
  $mypassword = $_SESSION['mypassword'];
  $myuser_id = $_SESSION['myuser_id'];
  $profile_id = $_GET['user'];
  echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1><a href='index.php'>RecruiDB</a></h1></div>";
  echo "<div id='second-div' style='text-align:right;width:50%'><a href=developer_profile.php?user={$myuser_id}><img src='./dev_profile.png' style='height:64;width:64'></a><a href=dev_stats.php><img src='./dev_stats.png' style='height:64;width:64'></a><a href=messages.php?userid={$myuser_id}><img src='./messages.png' style='height:64;width:64'></a></div></div><hr/>";

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
     if( isset($_POST["endorse"]))
     {
       $endorse_skill_name = $_POST["endorse"];
       $sql = "SELECT skill_id FROM Skill WHERE skill_name LIKE '$endorse_skill_name'";
       $result = mysqli_query($db, $sql);
       $endorse_skill_id = mysqli_fetch_array($result, MYSQLI_ASSOC);
       $endorse_skill_id = $endorse_skill_id["skill_id"];
       $sql = "INSERT INTO Endorsement VALUES (".$endorse_skill_id.", ".$profile_id.", ".$myuser_id.")";
       $result = mysqli_query($db, $sql);
     }
     if( isset($_POST["add_skill"]))
     {
       if( $_POST["add_skill"] != 0)
       {
         $endorse_skill_name = $_POST["skill_name"];
         $sql = "SELECT * FROM Skill WHERE skill_name LIKE '$endorse_skill_name'";
         $result = mysqli_query($db, $sql);
         $endorse_skill_id = mysqli_fetch_array($result, MYSQLI_ASSOC);
         if( $endorse_skill_id["skill_id"])
         {
           $sql = "INSERT INTO DeveloperSkill
                   VALUES (".$endorse_skill_id.", ".$myuser_id.")";
           $result = mysqli_query($db, $sql);
         }
         else
         {
           $sql = "INSERT INTO Skill
                   VALUES (NULL, '$endorse_skill_name')";
           $result = mysqli_query($db, $sql);
           $sql = "SELECT * FROM Skill WHERE skill_name LIKE '$endorse_skill_name'";
           $result = mysqli_query($db, $sql);
           $endorse_skill_id = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $endorse_skill_id = $endorse_skill_id["skill_id"];
           $sql = "INSERT INTO DeveloperSkill
                   VALUES ($endorse_skill_id, $myuser_id);";
           $result = mysqli_query($db, $sql);
         }
       }
     }

     if( isset($_POST["editpic"]))
     {
       if( $_POST["editpic"] != 0)
       {
         $picurl = $_POST["picurl"];
         $sql = "UPDATE User SET picurl = '$picurl' WHERE user_id = '$myuser_id'";
       $result = mysqli_query($db, $sql);
       }
     }

   }

  $sql = "SELECT * FROM User WHERE user_id = $profile_id";
  $result = mysqli_query($db,$sql);
  $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $profile_name = $row1["user_name"];
  $profile_biog = $row1["biography"];
  $profile_purl = $row1["picurl"];
  $sql = "SELECT school FROM Developer WHERE user_id = $profile_id";
  $result = mysqli_query($db,$sql);
  $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $profile_school = $row1["school"];


  $sql = "SELECT skill_name, count(*)
          FROM Endorsement AS e, Skill AS s, DeveloperSkill AS ds
          WHERE ds.skill_id = s.skill_id
          AND ds.user_id = $profile_id
          AND e.skill_id = ds.skill_id
          AND e.to_id = ds.user_id
          GROUP BY skill_name";
  $endorsed_result = mysqli_query($db,$sql);
  $sql = "SELECT skill_name
          FROM Skill AS s, DeveloperSkill AS ds
          WHERE ds.skill_id = s.skill_id
          AND ds.user_id = $profile_id
          AND ds.user_id NOT IN ( SELECT user_id FROM Endorsement as e
          WHERE e.to_id = $profile_id AND e.skill_id = s.skill_id)";
  $not_endorsed_result = mysqli_query($db,$sql);


  $edit_pic_html = "";
  if( $myuser_id == $profile_id)
  {
    $edit_pic_html = '
    <form style="text-align:right;" method="post" action="./developer_profile.php?user='.$profile_id.'">
    <p><input style="text;width:200" name="picurl" value="http://"/></p>
    <p><span style="font-family: Arial;"><span style="font-size: 13.3333px;"></span></span>
    <button name="editpic" value="1">Edit picture</button></p>
    </form>
    ';
  }

  $profile_pic_html =
  '
  <div id="first-div" style="text-align:left;">
      <img src="' . $profile_purl . '" style="height:200;width:200"><img>
      '.$edit_pic_html.'
  </div>
  ';
  $dev_info_div =
  '
  <div id="second-div" style="text-align:left;">
      <h2>'.$profile_name.'</h2>
      <form style="text-align: left;" action="./dev_stats.php">
      <p><span style="font-family: Arial;"><span style="font-size: 13.3333px;"></span></span> <input type="submit" value="See stats!" /></p>
      </form>
      <p>School: <a style="font-style:italic">'. $profile_school .'</a></p>
      <p>' . $profile_biog . '</p>
  </div>
  ';
  $profile_div =
  '
  <div class="busol">
    '.$profile_pic_html.'
    <div style="width:20pt;"></div>
    '.$dev_info_div.'
  </div>
  ';
  // echo $developer_top_bar . "<br/>";
  echo $profile_div;
  echo '<h3>Skills</h3>';
  while($row = mysqli_fetch_array($endorsed_result, MYSQLI_ASSOC))
  {
     echo $row['skill_name'] . " [" . $row['count(*)'] . "]";
     echo '
     <form action="" method="post">
         <button name="endorse" value="'.$row['skill_name'].'">Endorse</button>
     </form><br/>
     ';
  }
  while($row = mysqli_fetch_array($not_endorsed_result, MYSQLI_ASSOC))
  {
     echo $row['skill_name'] . " [0]<br/>";
     echo '
     <form action="" method="post">
         <button name="endorse" value="'.$row['skill_name'].'">Endorse</button>
     </form><br/>
     ';
  }

  if( $myuser_id == $profile_id)
  {
    echo '
    <form name="Form" style="text-align: left;" onsubmit="" action="" method = "post">
      <p>New Skill: <input name="skill_name" type="text" /></p>
      <button name="add_skill" value="1">Add Skill!</button></p>
    </form>
    ';
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

<form style="text-align: center;" action="./developer_home.php">
<p><span style="font-family: Arial;"><span style="font-size: 13.3333px;"><br /></span></span> <input type="submit" value="Go back" /></p>
<a href='index.php'><button type="button">Logout</button></a>
<p>&nbsp;</p>
<hr />
<p>&nbsp;</p>
</form>


</html>
