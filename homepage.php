
<?php

session_start();


if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
{		
		echo '<header><h1>MovieMadness</h1>Please Sign In</header>';
			echo 'Guest';
	echo  date("(D:M:Y)");
		echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a class="" href="advancesearch.php">Advanced Search</a>
		<a href="register.php">Register</a>
		<a href="signIn.php">Sign In</a>
		
		</div>';
}

else if ( $_SESSION['access_level'] == 'Member' )
{
echo '<header><h1>MovieMadness</h1> Welcome '.$_SESSION['username'].'</header>';
	echo ''.$_SESSION['username']. ' ';
	echo 'signed in on ';
	echo  date("(D:M:Y)");
	echo '<div class="topnav">
	
		<a class="active" href="homepage.php">Home</a>
		<a class="" href="advancesearch.php">Advanced Search</a>
		<a href="logout.php" style="float:right">Log Out</a>
		<a href="editProfile.php" style="float:right">Edit Profile</a>
		</div>';
}
else if ( $_SESSION['access_level'] == 'Moderator' )
{
echo '<header><h1>MovieMadness</h1> Welcome '.$_SESSION['username'].'</header>';
	echo ''.$_SESSION['username']. ' ';
	echo 'signed in on ';
	echo  date("(D:M:Y)");
	echo 'As a MOD';
	echo '<div class="topnav">
	
		<a class="active" href="homepage.php">Home</a>
		<a class="" href="advancesearch.php">Advanced Search</a>
		<a href="logout.php" style="float:right">Log Out</a>
		<a href="listMembers.php">List Members</a>
		<a href="editProfile.php" style="float:right">Edit Profile</a>
		</div>';
}

else if ( $_SESSION['access_level'] == 'Admin' )
{
	echo '<header><h1>MovieMadness</h1> Welcome '.$_SESSION['username'].'</header>';
	echo ''.$_SESSION['username']. ' ';
	echo 'signed in on ';
	echo  date("(D:M:Y)");
	echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
		<a class="" href="advancesearch.php">Advanced Search</a>
		<a href="movieinput.php">Add Movie</a>
		<a href="stats.php">View Website Stats</a>
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

	if(isset($_GET['MovieID']))
	{
	$MovieID = '%'.$_GET['MovieID'].'%';
	$query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
	$result = $db->query($query);
	while ($row = $result->fetch_assoc())
		echo "DELETED";

{
	$delete="DELETE FROM moviesdb WHERE MovieID like '".$MovieID."'";
	$dresult=$db->query($delete);
}


{
	$delete="DELETE FROM ratings WHERE MovieID like '".$MovieID."'";
	$dresult=$db->query($delete);
}


{
	$delete="DELETE FROM ratingtable WHERE MovieID like '".$MovieID."'";
	$dresult=$db->query($delete);
}
	}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
	<title>MovieMadness</title>
	<link rel="stylesheet" type="text/css" href="mycss2.css"/>
	<link rel="stylesheet" type="text/css" href="mycss.css" title="test"/>
</head>

<body>
<form action="searchbar.php" method="get" class="search" name="searchform">
	<b>Search Term</b>: <input class="input" type="text" placeholder="Search for Movie" name="searchinput"/>
	<input type="submit"  value="Search"/>
</form>

<div class="table1">
	<table class="movies" style="width:100%">
		<tr>
			<th>Movie Name</th>
		</tr>

		<?php
			$out_query = 'SELECT * FROM moviesdb';
			$out_result = $db->query($out_query);

				for ($i=0 ; $i < $out_result->num_rows ; $i++)
				{
					($movie = $out_result->fetch_assoc());
					if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
					{
						echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a></tr>';
					}
		
					else if  ( $_SESSION['access_level'] == 'Member' )
					{
						echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a><br /></tr>';
					}
					else if  ( $_SESSION['access_level'] == 'Moderator' )
					{
						echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a><br /></tr>';
					}
		
					else if ( $_SESSION['access_level'] == 'Admin' )
					{	
						echo '<tr><td><a href="MovieView.php?MovieID='.$movie['MovieID'].'"><b>'.$movie['movieName'].' (' .$movie['Date'].')</b></a>
						- <a class="ap" href="homepage.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Delete ' .$movie['movieName']. '?\');">Delete</a>
						- <a class="ap" href="edit.php?MovieID='.$movie['MovieID'].'" onclick="return confirm (\'Are you sure you want to Edit ' .$movie['movieName']. ' ?\');">Edit</a></td></tr>';
					}
				}
		?>

	</table>
</div>
</body>
</html>