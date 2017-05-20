<?php
   include('config.php');
   session_start();
 	$myusername = $_SESSION['myusername'];
	$mypassword = $_SESSION['mypassword'];

	echo "<h1>Welcome </h1>";

	//ACCOUNT CLOSE
	if(isset($_GET["delete"])){

		$getURI = $_GET["delete"];
		$aidValid = "select * from owns where aid='$getURI'";
		$resultValid = mysqli_query($db, $aidValid);
		if($resultValid->num_rows >=2) echo "The account cannot be deleted!";
		else{
			$ownsQuery = "delete from owns where aid = '$getURI' and cid='$mypassword'";
			$accountQuery = "delete from account where aid = '$getURI'";

			$ownsqueryresult = mysqli_query($db, $ownsQuery);
			$accountqueryresult = mysqli_query($db, $accountQuery);

			if($ownsqueryresult && $accountqueryresult) echo "The account is deleted successfully!";
			else echo "The account cannot be deleted!";

		}
	}

 	$sql = "SELECT aid, branch, balance, openDate FROM account NATURAL JOIN owns where cid='$mypassword'";

	$result = $db->query($sql);

	if ($result->num_rows > 0) {
		// traverse each row
		echo "<table>";
		echo '<tr>';
        echo '<th> aid </th>';
		echo '<th> branch </th>';
		echo '<th> balance </th>';
		echo '<th> open date </th>';
       	echo '<th> close account </th>';

        echo '</tr>';
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["aid"]. "</td><td>" . $row["branch"]. "</td><td>" . $row["balance"]. "</td><td>" . $row["openDate"]."</td>";
			$aidDel = $row['aid'];
			echo "<td><a href = 'welcome.php?delete=$aidDel'><input id='delbtn' type='submit' value='Close'/></a></td></tr>";
		}

		echo("</table>");

	} else {
		echo "0 results";
	}

?>
<html">

   <head>
      <title>Welcome </title>
   </head>
   <style type="text/css">
        table, th, td {
            border: 1px solid #00FF00;
			align-self:"center";
			align-items:"left";
        }
		tr:hover {background-color: #b4eeb4}
    </style>
   <body>
      <h2><a href = "logout.php">Sign Out</a></h2>
      <br>
      <h2><a href = "moneytransfer.php">Money Transfer</a></h2>

   </body>

</html>
