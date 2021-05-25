<?php

session_start();
if (!isset($_SESSION['username']) || $_SESSION['access_level'] != 'Admin' )
	{
		header('Location: homepage.php');
	}

else if ( $_SESSION['access_level'] == 'Member' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a href="logout.php" style="float:right">Log Out</a>
		</div>';
}
else if ( $_SESSION['access_level'] == 'Moderator' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a href="logout.php" style="float:right">Log Out</a>
		</div>';
}

else if ( $_SESSION['access_level'] == 'Admin' )
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
<!DOCTYPE hmtl>
<html>
<head>
    <title>MovieMadness</title>
        <script src="errors.js"></script> 
    <link rel="stylesheet" type="text/css" href="mycss.css"/>
    <link rel="stylesheet" type="text/css" href="mycss2.css"/>
</head>
<body>
<table>
<tr>
<?php
 $que= "SELECT ROUND(Count(UserID), 1) AS RatingAverage FROM memberdetails";
        $resu = $db->query($que);
		while ($row = $resu->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td>Total: <b>'.$row['RatingAverage'].'</b>Users</td> ';
			}
?>
<?php
 $query= "SELECT (SUM(AccessLevel = 'Admin')) AS RatingAverage FROM memberdetails";
        $result = $db->query($query);
		while ($row = $result->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td><br/><b>'.$row['RatingAverage'].'  Admin</b></td> ';
			}
?>

<?php
 $quer= "SELECT (SUM(AccessLevel = 'Member')) AS RatingAverage FROM memberdetails";
        $resul = $db->query($quer);
		while ($row = $resul->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td><br/><b>'.$row['RatingAverage'].'  Members</b></td>';
			}
?>

<?php
 $que= "SELECT (SUM(AccessLevel = 'Moderator')) AS RatingAverage FROM memberdetails";
        $resu = $db->query($que);
		while ($row = $resu->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td><br/><b>'.$row['RatingAverage'].' Moderator</b></td>';
			}
?>
<br/>
<?php
 $que= "SELECT (Count(MovieID)) AS RatingAverage FROM moviesdb";
        $resu = $db->query($que);
		while ($row = $resu->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td><br/><b>'.$row['RatingAverage'].' Movies</b><br/></td>';
			}
?>

<?php
 $qu= "SELECT  ROUND(AVG(YearOfBirth),1) AS RatingAverage FROM memberdetails";
        $res = $db->query($qu);
		while ($row = $res->fetch_assoc())
		$year= ''.$row['RatingAverage']. '';
	$date= date('Y');
	echo '<td><b>Average Age Of users of the site:</b> ';
	echo $date - $year;
	echo ' Years Old </td>';
?>
<br/>
<?php
 $qu= "SELECT * FROM moviesdb, ratingtable WHERE moviesdb.MovieID LIKE ratingtable.MovieID GROUP BY moviesdb.movieName
having count(ratingtable.MovieID) = (
  select count(ratingtable.MovieID) from ratingtable
  group by ratingtable.MovieID
  order by count(ratingtable.MovieID) desc
  limit 1)
";
        $res = $db->query($qu);
		while ($row = $res->fetch_assoc())
		$year= 'Movie With the Most Comments is: '.$row['movieName']. '';
	echo '<td>'.$year.'';
?>
<?php
 $qu= "SELECT (Count(Chat)) AS RatingAverage FROM ratingtable, moviesdb WHERE ratingtable.MovieID LIKE  moviesdb.MovieID GROUP BY ratingtable.MovieID
having (Count(ratingtable.MovieID)) = (
  select (Count(ratingtable.MovieID)) from ratingtable 
  GROUP BY ratingtable.MovieID
  ORDER BY (Count(ratingtable.MovieID)) desc
  limit 1 )
";
        $res = $db->query($qu);
		while ($row = $res->fetch_assoc())
		$year= ' The number of commnets is : '.$row['RatingAverage']. '';
	echo ''.$year.'</td>';
?>

<?php
 $qu= "SELECT * FROM moviesdb, ratings WHERE moviesdb.MovieID LIKE ratings.MovieID GROUP BY ratings.MovieID
having ROUND(AVG(ratings.MovieRating), 2) = (
  select ROUND(AVG(ratings.MovieRating), 2) from ratings
  group by ratings.MovieID
  order by ROUND(AVG(ratings.MovieRating), 2) desc
  limit 1)
";
        $res = $db->query($qu);
		while ($row = $res->fetch_assoc())
		$year= '<td>Movie With the highest rating : '.$row['movieName']. '';
	echo '<td>'.$year.'';
?>

<?php
 $qu= "SELECT ROUND(AVG(MovieRating), 2) AS RatingAverage FROM ratings, moviesdb WHERE ratings.MovieID LIKE  moviesdb.MovieID GROUP BY ratings.MovieID
having ROUND(AVG(ratings.MovieRating), 2) = (
  select ROUND(AVG(ratings.MovieRating), 2) from ratings 
  GROUP BY ratings.MovieID
  ORDER BY ROUND(AVG(ratings.MovieRating), 2) desc
  limit 1 )
";
        $res = $db->query($qu);
		while ($row = $res->fetch_assoc())
		$year= ': that rating is  ' .$row['RatingAverage']. '';
	echo ''.$year.'</td>';
?>

</tr>
</table>
</body>
</html>