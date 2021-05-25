<?php
	session_start();

	if (!isset($_SESSION['username']))
	{
		header('Location: homepage.php');
	}

	elseif (isset($_SESSION['username']) &&  $_SESSION['access_level'] == 'Member' )
	{
		echo '<header><h1>MovieMadness</h1></header>';
		echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a href="logout.php" style="float:right">Log Out</a>
			<a href="editProfile.php" style="float:right">Edit Profile</a>
			</div>';
	}
	
	elseif (isset($_SESSION['username']) &&  $_SESSION['access_level'] == 'Admin' )
	{
		echo '<header><h1>MovieMadness</h1></header>';
		echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a href="movieinput.php">Add Movie</a>
			<a href="listMembers.php">List Members</a>
			<a href="logout.php" style="float:right">Log Out</a>
			<a href="editProfile.php" style="float:right">Edit Profile</a>
			</div>';
	}
		
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
$movieName=$_POST['MovieRating'];
$MovieID=$_POST['MovieID'];
$Username=$_POST['Username'];

$validation_error = false
;
if(empty($Username)){
    header("Location: homepage.php");
    $validation_error = true;
    exit();
    }
     
    if(empty($movieName)){
		echo "Movie rating missing";
    $validation_error = true;
    }
     
    if(!is_numeric($movieName)){
	echo "movie rating is not a number";
    $validation_error = true;
    }
	   if(!is_numeric($MovieID)){
	echo "movie ID is not a number";
    $validation_error = true;
    }
	if (strlen($movieName) > 10)
	{
		echo 'rating too long'.'<br/>';
		$validation_error = true;
	}
     

if ($validation_error){
echo 'error';
	
}
else{
	$query = "UPDATE ratings SET  MovieID='".$MovieID."', MovieRating='".$movieName."', Username='".$Username."'
	WHERE  Username = '".$_SESSION['username']."'";
	$result = $db->query($query);
}

if($result){
   header('Location: homepage.php');

}
	else{
		echo'<p>'.$db->error.'</p>';
	}
}

if (isset($_SESSION['username']))
		{
			$pquery = "SELECT * FROM memberdetails WHERE Username = '".$_SESSION['username']."'";
			$presult = $db->query($pquery);
			$row = $presult->fetch_assoc();
		}
		else
		{
				echo'<p>'.$db->error.'</p>';
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
<div>
<?php
	$mquery= "SELECT * FROM ratings WHERE Username = '".$_SESSION['username']."'";
	$mresult = $db->query($mquery);
while ($row = $mresult->fetch_assoc())


?>
<br/>
<form name="form1" method="post" onsubmit="return form101();" action="editrating.php">
<table>
<tr>
<th>Username</th>
<th>New Rating</th>
<th>MovieID</th>
</tr>
<tr>
<td><select name="Username"><option><?php $mresult = $db->query($mquery);
 while ($row = $mresult->fetch_assoc()) 
	 echo ''.$row['Username'].''; ?></option></select></td>

<td><select name="MovieRating">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
</select></td>

<td><select name="MovieID"><option><?php $mresult = $db->query($mquery);
 while ($row = $mresult->fetch_assoc()) 
	 echo ''.$row['MovieID'].''; ?></option></select></td></tr>
 
 
</table>
<input name="editsubmit" type="submit" Value="Submit"/> 
</form>
</div>
</body>
</html>