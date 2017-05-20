<?php

include('config.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // get the username and password sent from form

  $myusername = mysqli_real_escape_string($db,$_POST['username']);
  $mypassword = mysqli_real_escape_string($db,$_POST['password']);

  $_SESSION[myusername] = $myusername;
  $_SESSION[mypassword] = $mypassword;

  $sql = "SELECT user_id FROM User WHERE username = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($db,$sql);
  $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);

  $count = mysqli_num_rows($result);

  // If result matches, table row count should be 1

  if($count == 1) {
    $sql = "SELECT user_id FROM Developer WHERE user_id =" .intval($row1["user_id"]);
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $devcount = mysqli_num_rows($result);

    $sql = "SELECT user_id FROM Company WHERE user_id =". intval($row1["user_id"]);
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $compcount = mysqli_num_rows($result);

    if($devcount >= 1) //developer
      header("location:developer_home.php");
    elseif($compcount >= 1) // company
      header("location:company_home.php");
    else {
      header("location:invalidlogin.php");
    }

  }else {
    $error = "The login name or password is invalid";
    echo $error;
  }
}
?>
<html>

<head>
  <title>Login Page</title>

  <style type = "text/css">
  body {
    font-family: Helvetica;
    font-size:16px;
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
  label {
    font-weight:bold;
    width:100px;
    font-size:14px;
  }

  .box {
    border:#666666 solid 1px;
  }
  </style>

</head>

<h1>RecruiDB</h1>
<hr />
<p>&nbsp;</p>
<h2 style="text-align: center;"><strong>Login to RecruiDB</strong></h2>

<body bgcolor = "#FFFFFF">

  <div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

      <div class = "bucenter" style = "margin:30px">

        <form onsubmit="return validateForm()" action = "" method = "post" name="Form" id="Form">
          <label class = "myp" >UserName: </label><input type = "text" name = "username" class = "box"/><br /><br />
          <label class = "myp" >Password: </label><input type = "password" name = "password" class = "box" /><br/><br />
          <input type = "submit" value = " Submit "/><br />
        </form>

        <script type="text/javascript">
        function validateForm(){
          var un=document.forms["Form"]["username"].value;
          var pass=document.forms["Form"]["password"].value;
          if ((un==null || un=="") && (pass==null || pass=="")){
            alert("Please fill the required fields!");
            return false;
          }
          if (un==null || un==""){
            alert("Please fill the username field!");
            return false;
          }
          if (pass==null || pass==""){
            alert("Please fill the password field!");
            return false;
          }
        }
        </script>

      </div>
      <hr />
      <h4>&nbsp;Don't have an account?</h4>
      <p><a href="./register_developer.php">Create a developer account!</a></p>
      <p><a href="./register_company.php">Create a company account!</a></p>
    </div>

  </div>

</body>
</html>
