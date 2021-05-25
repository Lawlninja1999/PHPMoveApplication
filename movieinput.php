<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['access_level'] != 'Admin' )
{
header('Location: signIn.php');
}

else
	
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a href="movieinput.php">Add Movie</a>
		<a href="listMembers.php">List Members</a>
		<a href="logout.php" style="float:right">Log Out</a>
		<a href="editProfile.php" style="float:right">Edit Profile</a>
		</div>';
	
@ $db = new mysqli('localhost', 'root', '', 'website');
if (mysqli_connect_error())
{
	echo 'error: <br/>'.mysqli_connect_error();
	exit;
}

?>
<?php
if(isset($_POST['submit'])){
	$movieName=$_POST['movieName'];
$Director =$_POST['Director'];
$Date=$_POST['Date'];
$Duration=$_POST['Duration'];
$Writers=$_POST['Writers'];
$plot=$_POST['plot'];
$submit=$_POST['submit'];


$validation_error = false;

$email_query = "SELECT movieName FROM moviesdb WHERE movieName = '".$movieName."' && Date = '".$Date."'";
	$email_results = $db->query($email_query);
	if($email_results->num_rows > 0)
	{
		echo "movie already exit!";
			echo '<a href="javascript: history.back();">Go back</a>';
		$validation_error = true;
	}



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
	if (strlen($Duration) > 3)
	{
		echo 'Duration is too long'.'<br/>';
		$validation_error = false;
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
echo 'Opps theres a fault in your entry';	
exit();
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
	$query = "INSERT INTO moviesdb VALUES ('".$movieName."', '".$Director."','".$Date."','".$Duration."','".$Writers."','".$plot."', NULL)";
	$result = $db->query($query);
}
if($result)
{
		header('Location: homepage.php');
}


}
?>


<!DOCTYPE hmtl>
<html lang="en"> 
<head>
    <Title>MovieMadness</Title> 
    <script src="errors.js"></script> 
	<link rel="stylesheet" type="text/css" href="mycss.css"/>
	<link rel="stylesheet" type="text/css" href="mycss2.css"/>
</head>


<body>
    <h4>Movie Signup</h4>
<div>
<br/>
<form action="movieinput.php" name="form1" method="post" onsubmit="return form101();">
<table>
	<tr>
		<th>Movie Name</th>
		<th>Director</th>
		<th>Year Of Release</th>
		<th>Duration</th>
		<th>Writers</th>
		<th>Plot</th>
	</tr>
	<tr>
		<td><input type="text" name="movieName" placeholder="Movie Name"/>*</td>
		<td><input type="text" name="Director" placeholder="Director Name"/>*</td><br/>
		<td><input type="text" name="Date" maxlength="4" placeholder="Year of release"/>*</td><br/>
		<td><input type="text" name="Duration" maxlength="3" placeholder="Minutes in length"/>*</td><br/>
		<td><input type="text" name="Writers" placeholder="Writers"/>*</td><br/>
		<td><textarea name="plot" rows="10" cols="50"> </textarea> *</td></tr>
</table>
<input name="submit" type="submit" Value="Submit">
</form>
</div>
</body>
</html>