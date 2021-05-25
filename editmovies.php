<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['access_level'] != 'Admin' )
{
	header('Location: signIn.php');
}

else
	
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
		<a href="homepage.php">Home</a>
		<a href="movieinput.php">Add Movie</a>
		<a class="active" href="edit.php">Edit Movie</a>
		<a href="listMembers.php>"List Members</a>
		<a href="logout.php" style="float:right">Log Out</a>
		</div>';
		
@ $db = new mysqli('localhost', 'root', '', 'website');
if (mysqli_connect_error())
{
	echo 'error: <br/>'.mysqli_connect_error();
	exit;
}

?>
<?php
if(isset($_POST['editsubmit']))
{
$movieName=$_POST['movieName'];
$Director =$_POST['Director'];
$Date=$_POST['Date'];
$Duration=$_POST['Duration'];
$Writers=$_POST['Writers'];
$plot=$_POST['plot'];
$submit1=$_POST['editsubmit'];


$validation_error = false;

if(empty($movieName)){
	echo 'Movie Name is empty'.'<br/>';
	$validation_error = true;
	}
	if(empty($Director)){
	echo 'Directoris empty'.'<br/>';
	$validation_error = true;
	}
	if(empty($Duration)){
	echo 'Duration is empty'.'<br/>';
	$validation_error = true;
	}
    if(!is_numeric($Duration)){
	echo 'Duration has to be a number'.'<br/>';
	$validation_error = true;
	}
	if(!is_numeric($Date)){
echo 'Date is not a number'.'<br/>';
$validation_error = true;
	}
	if (strlen($Date) < 4)
	{
		echo 'Date is too long'.'<br/>';
		$validation_error = true;
	}
		if (strlen($Date) > 4)
	{
		echo 'Date is too short'.'<br/>';
		$validation_error = true;
	}
	if (strlen($Duration) < 3)
	{
		echo 'Duration is too long'.'<br/>';
		$validation_error = true;
	}
	if(empty($Writers)){
	echo 'Writers is empty'.'<br/>';
	$validation_error = true;
	}
	if(empty($Date)){
	echo 'Date is empty'.'<br/>';
	$validation_error = true;
	}

if ($validation_error){
echo 'error';
	
}
$HA ="SELECT * FROM memberdetails WHERE Username = '".$_SESSION['username']."'";
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
	if(''.$row['AccessLevel'].'' !== 'Admin')
	{
		
		header("Location: Logout.php");
		exit();
	} 
	
else{
	$query = "UPDATE moviesdb SET movieName='".$movieName."', Director='".$Director."',Date='".$Date."',Duration='".$Duration."',Writers='".$Writers."',Plot='".$plot."'
	WHERE movieName = '".$_POST['movieName']."'";
	$result = $db->query($query);
}

if($result){
	
	header("Location: homepage.php");
	exit;
}
	else{
		echo'<p>'.$db->error.'</p>';
	}
}


?>