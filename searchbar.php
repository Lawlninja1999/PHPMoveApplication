<?php

session_start();


if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
{		
		echo '<header><h1>MovieMadness</h1></header>';
		echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a href="register.php">Register</a>
		<a href="signIn.php">Sign In</a>
		</div>';
}

else if ( $_SESSION['access_level'] == 'Member' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a href="logout.php" style="float:right">Log Out</a>
		</div>';
}

else if ( $_SESSION['access_level'] == 'Admin' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a href="movieinput.php">Add Movie</a>
		<a href="listMembers.php">List Members</a>
		<a href="logout.php" style="float:right">Log Out</a>
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

	if(isset($_GET['MovieID']))
	{
	$MovieID = '%'.$_GET['MovieID'].'%';
	$query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
	$result = $db->query($query);
while ($row = $result->fetch_assoc())
	echo "DELETED";
}
?>
<?php
if (isset($_GET['MovieID']))
{
	$delete="DELETE FROM moviesdb WHERE MovieID like '".$MovieID."'";
	$dresult=$db->query($delete);
}


?>
<!DOCTYPE hmtl>
<html>
<head>
<title>Movie Madnessa</title>
	<link rel="stylesheet" type="text/css" href="mycss.css"/>
	<link rel="stylesheet" type="text/css" href="mycss2.css"/>
</head>
<body>

<h4><u>Search Results<u></h4>
<div class="table1">
	<table class="movies" style="width:100%">
	<tr>
	<th>Movie Name</th>
	</tr>
							
<?php
					if(isset($_GET['search_input']))
	{
		$search_input = '%'.$_GET['search_input'].'%';
		$query = "SELECT * FROM moviesdb WHERE movieName LIKE '".$search_input."'";
		$search_input = $db->query($query); 
		while ($movie = $search_input->fetch_assoc())
if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member')
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
					else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
		
	if(isset($_GET['box']))
	{
		$search_input = '%'.$_GET['search_input'].'%';
		$query = "SELECT * FROM moviesdb WHERE Director LIKE '".$search_input."'";
		$search_input = $db->query($query); 
		while ($movie = $search_input->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member')
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
	
	if(isset($_GET['vbox']))
	{
		$search_input = '%'.$_GET['search_input'].'%';
		$query = "SELECT * FROM moviesdb WHERE Writers LIKE '".$search_input."'";
		$search_input = $db->query($query); 
		while ($movie = $search_input->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
	
	
	
 if(isset($_GET['pbox']))
	{
		$search_input = '%'.$_GET['search_input'].'%';
		$query = "SELECT * FROM moviesdb WHERE Plot LIKE '".$search_input."'";
		$search_input = $db->query($query); 
		while ($movie = $search_input->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}

	?>
	</div>
	<div>
	<tr><th>Year of release</th></tr>
	<?php

	 if(isset($_GET['YearOfRelease']))
		echo 'Date is less then filled in';
	{
		$year = ''.$_GET['year'].'';
		if($year == "a")
		{
		$YearOfRelease = ''.$_GET['YearOfRelease'].'';
		$query = "SELECT * FROM moviesdb WHERE Date < '".$YearOfRelease."'";
		$YearOfRelease = $db->query($query); 
		while ($movie = $YearOfRelease->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
 else if($year == "b")
		{
		$YearOfRelease = ''.$_GET['YearOfRelease'].'';
		$query = "SELECT * FROM moviesdb WHERE Date LIKE '".$YearOfRelease."'";
		$YearOfRelease = $db->query($query); 
		while ($movie = $YearOfRelease->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member')
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
else 
		{
		$YearOfRelease = ''.$_GET['YearOfRelease'].'';
		$query = "SELECT * FROM moviesdb WHERE Date > '".$YearOfRelease."'";
		$YearOfRelease = $db->query($query); 
		while ($movie = $YearOfRelease->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
	}
	}
?>
</div>

<div>
	<br/><tr><th>Duration</th></tr>
	<?php

	 if(isset($_GET['Duration']))
	{
		$L = ''.$_GET['L'].'';
		if($L == "a")
		{
		$Duration = ''.$_GET['Duration'].'';
		$query = "SELECT * FROM moviesdb WHERE Duration < '".$Duration."'";
		$Duration = $db->query($query); 
		while ($movie = $Duration->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
 else if($L == "b")
		{
		$Duration = ''.$_GET['Duration'].'';
		$query = "SELECT * FROM moviesdb WHERE Duration LIKE '".$Duration."'";
		$Duration = $db->query($query); 
		while ($movie = $Duration->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member')
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
else
		{
		$Duration = ''.$_GET['Duration'].'';
		$query = "SELECT * FROM moviesdb WHERE Duration > '".$Duration."'";
		$Duration = $db->query($query); 
		while ($movie = $Duration->fetch_assoc())
			if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' OR $_SESSION['access_level'] == 'Moderator' OR $_SESSION['access_level'] == 'Member' )
				{
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></td></tr>';
				}
				
			else
				{	
					echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
					- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
					- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
				}
	}
	}
?>
</div>
	</table>

</body>
</html>