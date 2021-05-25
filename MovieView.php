<?php
//Start or resume a session
session_start();
 
//If the "uname" session variable is not set or is empty, be a guest to the website
if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
{
    echo '<header><h1>MovieMadness</h1></header>';
    echo '<div class="topnav">
            <a class="active" href="homepage.php">Home</a>
            <a href="register.php">Register</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
            <a href="signIn.php">Sign In</a>
        </div>';
}
 
else if ( $_SESSION['access_level'] == 'Member' )
{
    echo '<header><h1>MovieMadness</h1></header>';
    echo '<div class="topnav">
            <a class="active" href="homepage.php">Home</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
            <a href="logout.php" style="float:right">Log Out</a>
        </div>';
}
else if ( $_SESSION['access_level'] == 'Moderator' )
{
    echo '<header><h1>MovieMadness</h1></header>';
    echo '<div class="topnav">
            <a class="active" href="homepage.php">Home</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
            <a href="logout.php" style="float:right">Log Out</a>
        </div>';
}
 
else if ( $_SESSION['access_level'] == 'Admin' )
{
    echo '<header><h1>MovieMadness</h1></header>';
    echo '<div class="topnav">
            <a class="active" href="homepage.php">Home</a>
            <a href="movieinput.php">Add Movie</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
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
if(isset($_POST['entersubmit'])){
$comment =$_POST['comment'];
$entersubmit=$_POST['entersubmit'];
$movieName=$_POST['movieName'];
$Username=$_POST['Username'];
 
$validation_error = false;
 
if(empty($Username)){
    header("Location: register.php");
    $validation_error = true;
    exit();
    }
     
    if(empty($comment)){
    $validation_error = true;
    }
     
    if(empty($movieName)){
    $validation_error = true;
    }
     
 
if ($validation_error){
    echo 'Error go back. <a href="javascript: history.back();">Go back</a>';
    exit();
}
$HA ="SELECT * FROM memberdetails WHERE Username = '".$Username."'";
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
	if(strtotime($row['Time'])> time ())
	{
		echo 'You cant comment';
		header("Location: Logout.php");
		exit();
	}
else{
    $query = "INSERT INTO ratingtable VALUES ('".$comment."', NULL, '".$movieName."',NULL,'".$Username."')";
    $result = $db->query($query);
}
 
if(!$result){
    echo "not added";
    echo '<p>'.$db->error.'</p>';
    echo 'Not added < a href="javascript: history.back();">Go back to movie view</a>';
    exit();
}
}
 ?>
<?php
 
if(isset($_POST['ratesubmit'])){
    $Rating=$_POST['Rating'];
$MovieID=$_POST['MovieID'];
$User=$_POST['User'];
 
$validation_error = false;
 
    if(empty($Rating)){
    $validation_error = true;
    }
     
    if(empty($User)){
        echo " You must be logged in to comment";
    header("Location: register.php");
    $validation_error = true;
     
    }
     
     
    if(empty($MovieID)){
    $validation_error = true;
    }
 
     
if ($validation_error){
    echo 'Error go back. <a href="javascript: history.back();">Go back</a>';
    exit;
}

 $HA ="SELECT * FROM memberdetails WHERE Username = '".$User."'";
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
	if(strtotime($row['Time'])> time ())
	{
		echo 'You cant Rate';
		header("Location: Logout.php");
		exit();
	}
else{
    $query = "INSERT INTO ratings VALUES ('".$Rating."','".$MovieID."','".$User."',NULL)";
    $result = $db->query($query);
}
 
if(!$result){

    echo 'You cant Rate on the same movie twice <a href="javascript: history.back();">Go back</a>';
	exit();
		echo'<p>'.$db->error.'</p>';
}

}
?>
<?php
 if(isset($_GET['Delete']))
    {
	$Delete = ''.$_GET['Delete'].'';
	$query= "SELECT * FROM ratingtable WHERE chatID like '".$Delete."'";
	$result = $db->query($query);
	
$delete="DELETE FROM ratingtable WHERE chatID = '".$Delete."'";
	$deleteresult=$db->query($delete);
	if (!$deleteresult)
	{
		echo '<a href="javascript: history.back();">Comment Delete</a>';
    exit();
	}
	else{echo 'deleted';}
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
 
<div name="moviename and details">
<p><h2 class="name">
 
<?php
 
    if(isset($_GET['MovieID']))
    {
        $MovieID = '%'.$_GET['MovieID'].'%';
        $query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
        $result = $db->query($query);
    while ($row = $result->fetch_assoc())
        echo ''.$row['movieName'].'';
	}
    else{
		header('Location: homepage.php');
	}
	
   
 
?></h2>
</p>
 
 
<table style="overflow-x:auto;" class="movies">
<tr>
    <th> Movie Information</th>
	<th> Average Rating </th>
</tr>
 
<tr>
    <td>
    <?php
        $result = $db->query($query);
        while ($row = $result->fetch_assoc())
            echo 'Director Name: <b> '.$row['Director']. '</b>';
    ?>
<br/><br/>
 
    <?php
        $result = $db->query($query);
        while ($row = $result->fetch_assoc())
            echo 'Writers name: <b>' .$row['Writers']. '</b>';
    ?>
<br/><br/>
 

    <?php
        $result = $db->query($query);
        while ($row = $result->fetch_assoc())
            echo 'Date of release: <b>'.$row['Date'].'</b>';
    ?>   
<br/><br/>
    <?php
        $result = $db->query($query);
        while ($row = $result->fetch_assoc())
            echo 'Duration: <b>'.$row['Duration'].'</b>';
    ?>
<br/><br/>
    <?php
        $result = $db->query($query);
        while ($row = $result->fetch_assoc())
            echo 'Plot: <b> '.$row['Plot'].'</b>';
    ?>
 
    </td>
	
	<?php
        $MovieID = '%'.$_GET['MovieID'].'%';
        $query= "SELECT ROUND(AVG(MovieRating), 2) AS RatingAverage FROM ratings WHERE MovieID LIKE '".$MovieID."'";
        $result = $db->query($query);
		while ($row = $result->fetch_assoc())
			if (empty($row['RatingAverage']))
			{
				echo '';
			}
			else
			{
				echo '<td><b>'.$row['RatingAverage'].' / 10</b></td>';
			}
	?>
	
</tr>
</table>
</div>
 

<div class="rating">
<?php
 
    $MovieID = '%'.$_GET['MovieID'].'%';
    $query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
    $result = $db->query($query);

 
?>
<?php

    $MovieID = '%'.$_GET['MovieID'].'%';
    $uquery= "SELECT * FROM ratings WHERE MovieID like MovieID = '".$MovieID."'";
    $uresult = $db->query($uquery);
?>
<form action="MovieView.php?MovieID=<?php echo $_GET['MovieID'];?>" name="rate30" method="post" onsubmit="return rate2();">
<table>
<tr>
 
<?php
 
        ($row = $result->fetch_assoc());
        if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
        {

        }
        else
		{
            echo '<h4 style="font-size: 20px; color: red;">Rate Movie</h4>
			<th>User</th>
			<th>Rating</th>
			<th>MovieID</th>
			<th>Edit</th>';
           
        }
         
         
 ?>
</tr>

<tr>
 
<?php
	($row = $result->fetch_assoc());
	if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
	{
		
	}
	else
	{
		echo '<td ><select name="User"><option>
		'.$_SESSION['username'].'</option></select></td>';
		echo '<input name="ratesubmit" type="submit" Value="Submit"/>';
	}
?>
 
<?php
 
	($row = $result->fetch_assoc());
	if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
	{
		
	}
	else 
	{
		echo '<td ><select name="Rating">
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
		</select></td>';
	}
?>

<?php

	($row = $result->fetch_assoc());
	if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
	{
		
	}
	else
	{
		
		$result = $db->query($query);
		while ($row = $result->fetch_assoc())
		echo '<td ><select name="MovieID"><option>'.$row['MovieID'].' </option></select></td>';
	}
?>

<?php

	($row = $result->fetch_assoc());
	if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
	{
		
	}
	else
	{
		
		$uresult = $db->query($uquery);
		($row = $uresult->fetch_assoc());
		echo '<td><a class="ap" href="editrating.php?EDIT='.$row['Username'].'" onclick="return confirm (\'Are you sure you want to Edit your rating?\');">Edit</a></td>';
	}
?>
 
</tr>
</table></br></br>
</form>
</div>
 
<div class="comment">
 <?php
    $MovieID = '%'.$_GET['MovieID'].'%';
    $query= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
    $result = $db->query($query);
 
?>
<form action="MovieView.php?MovieID=<?php echo $_GET['MovieID'];?>" name="rate20" method="post" onsubmit="return rate108();">
<table>
 <?php
 
        ($row = $result->fetch_assoc());
        if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
        {
        }
else 
{
echo '<h4 style="font-size: 20px; color: red;">Post Comment</h4>
<tr>
<th>User</th>
<th>Comment</th>
<th>MovieID</th>
</tr>';
}?>
<tr>
 <?php
 
        ($row = $result->fetch_assoc());
        if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
        {
        }
        else{
			echo '<td ><select name="Username"><option>
'.$_SESSION['username'].'</option></select></td>';
  echo '<input name="entersubmit" type="submit" Value="Submit"/>';
		}
  ?>
  
 <?php
 
        ($row = $result->fetch_assoc());
        if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
        {
        }
        else{
			echo '<td><input class="input101" name="comment"  type="text" placeholder="Write a comment"/></td>';
		}
  ?>
  
  <?php

	($row = $result->fetch_assoc());
	if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
	{
		
	}
	else
	{
		
		$result = $db->query($query);
		while ($row = $result->fetch_assoc())
		echo '<td ><select name="movieName"><option>'.$row['MovieID'].' </option></select></td>';
	}
?>
  

  
 </tr>
</table>
</form>
</div>
 
 <div class="displaycomments">
<?php
    $MovieID = '%'.$_GET['MovieID'].'%';
    $iquery= "SELECT * FROM moviesdb WHERE MovieID like '".$MovieID."'";
    $iresult = $db->query($iquery);
 
?>
<?php
    $MovieID = '%'.$_GET['MovieID'].'%';
    $uquery= "SELECT * FROM ratingtable WHERE MovieID like '".$MovieID."' ";
    $uresult = $db->query($uquery);
?>
<h4 style="font-size: 20px; color: red;"><strong>Comments Posted</strong></h4>
<table  style="width:100%">
<tr>
<th>Discussion</th>
</tr>
 
<?php
$uresult = $db->query($uquery);
for ($i=1 ; $i <= $uresult->num_rows ; $i++)
    {
        ($row = $uresult->fetch_assoc());
        if( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
        {
            echo '<tr> <td>Username:'.$row['Username'].'<br/><br/>Chat: '.$row['Chat']. ' <br/><br/>'.$row['Date'].'</td></tr>';
        }
         
        else if ( $_SESSION['access_level'] == 'Member' )
        {
            echo '<tr>
            <td>Username: <a href="Userdets.php?UserID='.$row['Username'].'">'.$row['Username'].'</a><br/><br/>Discussion: '.$row['Chat']. ' <br/><br/>'.$row['Date'].'</td></tr>';
             
        }
		
		  else if ( $_SESSION['access_level'] == 'Moderator' )
        {
            echo '<tr>
            <td>Username: <a href="Userdets.php?UserID='.$row['Username'].'">'.$row['Username'].'</a>
			<br/><br/>Discussion: '.$row['Chat']. ' <br/><br/> '.$row['Date'].'
			<br/><br/><a class="ap" href="MovieView.php?Delete='.$row['chatID'].'" onclick="return confirm (\'Are you sure you want to Delete?\');">Delete</a></td>
            </tr>';
             
        }
         
         else if( $_SESSION['access_level'] == 'Admin' )
        {
            echo '<tr>
            <td>Username: <a href="Userdets.php?UserID='.$row['Username'].'">'.$row['Username'].'</a><br/><br/> Discussion: '.$row['Chat']. ' <br/><br/>'.$row['Date'].'</td></tr>';
        }
    }
     
      
?>
</table>
<h3><a href="javascript: history.back();">Back to Home</a></h3>
</div>
 
</body>
</html>