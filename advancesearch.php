<?php

session_start();


if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
{		
		echo '<header><h1>MovieMadness</h1>Please Sign In</header>';
			echo 'Guest';
	echo  date("(D:M:Y)");
		echo '<div class="topnav">
		<a class="active" href="homepage.php">Home</a>
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
		<a href="logout.php" style="float:right">Log Out</a>
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
<!DOCTYPE html>
<html lang="eng">
<head>
	<title>MovieMadness</title>
	<link rel="stylesheet" type="text/css" href="mycss2.css"/>
	<link rel="stylesheet" type="text/css" href="mycss.css" title="test"/>
</head>

<body>
<form action="searchbar.php" method="get" name="searchform">
	<b>Advance Search Term</b>: <br/><input  type="text" placeholder="Search for Movie" name="search_input"/><br/>
	Director name <input name="box" type="checkbox" />
	<br/> Writers name <input name="vbox" type="checkbox" />
	 <br/>Plot <input name="pbox" type="checkbox" />
	 
	 
	 <br/> Year Of Release<select name="year"><option value="a" selected="selected">Less then</option>
	 <option value="b">Same as</option>
	 <option value="c">More then</option></select>
	 <input  type="text" placeholder="Year of Release" name="YearOfRelease"/>
	 
	 
	 <br/> Duration<select name="L">
	 <option value="a" selected="selected">Less then</option>
	 <option value="b">Same AS</option>
	 <option value="c">More then</option></select>
	 <input  type="text" placeholder="Duration" name="Duration"/>
	<input type="submit"  name="submit" value="Search"/>
</form>
</body>
</html>
</html>