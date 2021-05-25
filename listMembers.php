<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['access_level'] == 'Member' OR '' )
{
	header('Location: signIn.php');
}

else
	
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
		<a href="homepage.php">Home</a>
		<a class="" href="advancesearch.php">Advanced Search</a>
		<a href="movieinput.php">Add Movie</a>
		<a class="active" href="listMembers.php">List Members</a>
		<a href="logout.php" style="float:right">Log Out</a>
		<a href="editProfile.php" style="float:right">Edit Profile</a>
		</div>';
		
		'<h2><strong>List Users</strong></h2>';
		

@ $db = new mysqli('localhost', 'root', '', 'website');

if (mysqli_connect_error())
{
	echo 'Error connecting to database:<br />'.mysqli_connect_error();
	exit;	
}


if (isset($_GET['del_id']))
{
	$HA ='SELECT * FROM memberdetails WHERE UserID= '.$_GET['del_id'];
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
if($_SESSION['username'] == ''.$row['Username'].'')
	{
		echo 'Sorry Admins can not delete their own accounts place contact another admin to complete this stage';
	} 
	else{
		$del_query = 'DELETE FROM memberdetails WHERE UserID = '.$_GET['del_id'];
	$del_results = $db->query($del_query);}
}

?>
<?php
$query = "SELECT * FROM memberdetails ORDER BY FirstName";


$results = $db->query($query);

echo '<p>'.$results->num_rows.' user(s) found.</p>';


echo '<table><tr>';
echo '<strong>Username<strong>';
echo '</tr>';


while ($row = $results->fetch_assoc())
{
	
	echo'<td><a href="Userdets.php?UserID='.$row['Username'].'">'.$row['Username'].'</a></td>';
	
	echo '<td><a href="editMember.php?edit_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Edit</a> ';
	echo '<a href="listMembers.php?del_id='.$row['UserID'].'"
	onclick="return confirm(\'Are you sure that you want to delete this user ' .$row['Username']. ' ?\');">Delete</a></td></tr>';
}

echo '</table>';


?>
<!DOCTYPE html>
<html>
<head>
	<title>List Members</title>
	<style type="text/css">
		th, td {border: 1px solid black; width: 150px; padding: 5px;}
	</style>
	<link rel="stylesheet" type="text/css" href="navigationBar.css">
	<link rel="stylesheet" type="text/css" href="mycss2.css">
</head>

<body>
</body>
<html>




	