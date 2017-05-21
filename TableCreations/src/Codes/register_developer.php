<?php
include('config.php');
session_start();

echo "<div class='bucenter'><div id='first-div' style='text-align:left;width:50%'><h1><a href='index.php'>RecruiDB</a></h1></div>";
echo "<div id='second-div' style='text-align:right;width:50%'><img src='./dev_profile.png' style='height:64;width:64'><img src='./dev_stats.png' style='height:64;width:64'><img src='./messages.png' style='height:64;width:64'></a></div></div>";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

  $uname = $_POST["uname"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $pass = $_POST["pw"];
  $website = $_POST["website"];
  $picurl = $_POST["picurl"];
  $bio = $_POST["bio"];
  $school = $_POST["school"];

  $sql = "INSERT INTO User VALUES (NULL, '$uname', '$name', '$email', '$pass', '$website', '$picurl', '$bio');";
  $result = mysqli_query($db, $sql);

   if( $result)
   {
     $sql = "SELECT * FROM User WHERE username LIKE '$uname'";
     $result = mysqli_query($db, $sql);
     $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
     $roww1 = $row1['user_id'];

     $sql = "INSERT INTO Developer VALUES (".$roww1.", '$school');";
     $result = mysqli_query($db, $sql);
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
</style>

<hr />
<p>&nbsp;</p>

<script type="text/javascript">
function validateForm(){
  var qt=document.forms["Form"]["name"].value;
  var dif=document.forms["Form"]["uname"].value;
  var cq=document.forms["Form"]["email"].value;
  var def=document.forms["Form"]["pw"].value;
  var ans=document.forms["Form"]["pw2"].value;
  var ws=document.forms["Form"]["website"].value;
  var sch=document.forms["Form"]["school"].value;
  var bio=document.forms["Form"]["bio"].value;
  var pu=document.forms["Form"]["picurl"].value;

  if (qt==null || qt=="" || dif==null || dif=="" || cq==null || cq=="" ||
      def==null || def=="" || ans==null || ans=="" || ws==null || ws=="" ||
      sch==null || sch=="" || bio==null || bio=="" || pu==null || pu=="")
  {
    alert("Please fill the required fields!");
    return false;
  }

  if( (def != ans))
  {
    alert("passwords dont match");
    return false;
  }
}
</script>

<h2 style="text-align: center;"><strong>Register&nbsp;as a developer</strong></h2>
<div align="center" style="text-align: center;">
  <div class="bucenter">
    <form name="Form" style="text-align: center;" onsubmit="return validateForm()" action="" method = "post">
      <p class="myp">name: <input name="name" type="text" /></p>
      <p class="myp">username: <input name="uname" type="text" /></p>
      <p class="myp">email: <input name="email" type="text" /></p>
      <p class="myp">password: <input name="pw" type="password" /></p>
      <p class="myp">password (retype): <input name="pw2" type="password" /></p>
      <p class="myp">website: <input name="website" type="text" /></p>
      <p class="myp">picture url: <input name="picurl" type="text" /></p>
      <p class="myp">school: <input name="school" type="text" /></p>
      <p class="myp">biography: <textarea name="bio" cols="40" rows="5"></textarea> </p>
      <p><span style="font-family: Arial;"><span style="font-size: 13.3333px;"><br /></span> </span>
      <input type="submit" value="Register" /></p>
    </form>
  </div>
</div>

<p>&nbsp;</p>
<hr />
<p>&nbsp;</p>
<h4>&nbsp;Don't have an account?</h4>
<p><a href="./register_developer.php">Create a developer account!</a></p>
<p><a href="./register_company.php">Create a company account!</a></p>
</html>
