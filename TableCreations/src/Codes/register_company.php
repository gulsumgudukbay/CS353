<?php

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
</style>
<h1>RecruiDB</h1>
<hr />
<p>&nbsp;</p>
<h2 style="text-align: center;"><strong>Register&nbsp;as a company</strong></h2>
<div align="center" style="text-align: center;">
<div class="bucenter"><form style="text-align: center;" action="./register_company.php">
<p class="myp">company name: <input name="name" type="text" /></p>
<p class="myp">username: <input name="uname" type="text" /></p>
<p class="myp">email: <input name="email" type="text" /></p>
<p class="myp">password: <input name="pw" type="password" /></p>
<p class="myp">password (retype): <input name="pw" type="password" /></p>
<p class="myp">website: <input name="website" type="text" /></p>
<p><span style="font-family: Arial;"><span style="font-size: 13.3333px;"><br /></span> </span> <input type="submit" value="Register" /></p>
</form></div></div>
<p>&nbsp;</p>
<hr />
<p>&nbsp;</p>
<h4>&nbsp;Don't have an account?</h4>
<p><a href="./register_developer.html">Create a developer account!</a></p>
<p><a href="./register_company.html">Create a company account!</a></p>
