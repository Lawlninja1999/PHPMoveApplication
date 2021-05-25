<?php

session_start();


if ( isset($_SESSION['username']) && $_SESSION['username'] != '' )
{
	header('Location: homepage.php');
	exit;
}
@ $db = new mysqli('localhost', 'root', '','website');
	if (mysqli_connect_errno())
	{
		echo 'Could not connect the database - Please try again later';
		exit;
	}

if ( isset($_POST['username']) )
{
   $HA= "SELECT * FROM memberdetails WHERE Username = '".$_POST['username']."'";
		$HO = $db->query($HA);
		while ($row = $HO->fetch_assoc())
		if (strtotime($row['Time'])> time ())
		{
			echo 'You Again? Sorry Your account is banned!<br/>';
			echo 'You have been banned for '.$row['Ban']. ' <br/>and the ban will end on '.$row['Time']. ' <br/>after this you will have access to your account again';
			echo'<br/><a href="homepage.php">Home</a>';
		}

	else{
	$query = "SELECT * FROM memberdetails WHERE Username='".$_POST['username']."' AND Password='".$_POST['password']."'";
	$results = $db->query($query);
	
	if ($results->num_rows == 0)
	{
		echo '<header style="color: red;">Invalid login.  Try again.</header>';
	}
	else
	{
		//Log the user in
		$user = $results->fetch_assoc();

		//Set session variables then redirect to menu page
		$_SESSION['username'] = $user['Username'];
		$_SESSION['access_level'] = $user['AccessLevel'];
		header('Location: homepage.php');
		exit;
	}
}
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>MovieMadness</title>
	<link rel="stylesheet" type="text/css" href="mycss2.css"/>
<header>
	<h1>MovieMadness</h2>
</header>

<div class="topnav">
	<a href="homepage.php">Home</a>
	<a href="register.php">Register</a>
	<a class="active" href="signIn.php">Sign In</a>
</div>

<form method="post" action="signIn.php">
	<table style="width: 10px;">
		<tr>
			<td>Username: <input type="text" name="username" /><br /></td>
		</tr>
		<tr>
			<td>Password: <input type="password" name="password" /><br /></td>
		</tr>
	</table>
	<input style="margin-top: 10px;" type="submit" value="Log In" />
</form>
