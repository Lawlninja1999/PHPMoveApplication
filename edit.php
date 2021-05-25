
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

	if(isset($_GET['MovieID']))
	{
	$MovieID = '%'.$_GET['MovieID'].'%';
	$query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
	$result = $db->query($query);

}
else{
	if (empty($_GET['MovieID']))
	{
		header('Location: homepage.php');
exit;
	}
}

?>
<br/>
<form name="form1" method="post" onsubmit="return form101();" action="editmovies.php">
<table>
<tr>
<th>Movie Name</th>
<th>Director</th>
<th>Date Of Release</th>
<th>`Duration</th>
<th>Writers</th>
<th>Plot</th>
</tr>
<tr>
<td><select name="movieName"><option><?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['movieName'].''; ?></option></select>*</td>

<td><input type="text" name="Director" value="<?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['Director'].''; ?>"/>*</td><br/>

<td><input type="text" name="Date" maxlength="4" value="<?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['Date'].''; ?>"/>*</td><br/>

<td><input type="text" name="Duration" maxlength="3" value="<?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['Duration'].''; ?>"/>*</td><br/>
 
<td><input type="text" name="Writers" value="<?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['Writers'].''; ?>"/></td>
 
<td><textarea value="cc" name="plot" rows="10" cols="50" ><?php $result = $db->query($query);
 while ($row = $result->fetch_assoc()) 
	 echo ''.$row['Plot'].''; ?> </textarea> *</td></tr>
 
</table>
<input name="editsubmit" type="submit" Value="Submit"> 
</form>
</div>
</body>
</html>