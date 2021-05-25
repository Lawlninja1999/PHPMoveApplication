<?php

session_start();
if ( !isset($_SESSION['username']) || $_SESSION['username'] == '' )
{
header('Location: signIn.php');
}

else if ( $_SESSION['access_level'] == 'Member' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
			<a href="logout.php" style="float:right">Log Out</a>
		</div>';
}
else if ( $_SESSION['access_level'] == 'Moderator' )
{
	echo '<header><h1>MovieMadness</h1></header>';
	echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a class="" href="advancesearch.php">Advanced Search</a>
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
		<a class="" href="advancesearch.php">Advanced Search</a>
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

	if(isset($_GET['UserID']))
	{
		$UserID = '%'.$_GET['UserID'].'%';
		$query= "SELECT * FROM memberdetails WHERE Username like '".$UserID."'";
		$oresult = $db->query($query);

		}

?>

<!DOCTYPE hmtl>
<html>
<head>
<title>ALLMOVIES.com</title>
<link rel="stylesheet" type="text/css" href="mycss.css"/>
<link rel="stylesheet" type="text/css" href="mycss2.css"/>

</head>
<body>

<p><h2 class="name">
</u></h2>
</h1>
</p>

<?php
		$oresult = $db->query($query);
	while ($row = $oresult->fetch_assoc())
	if (  ''.$row['Ban'].'' !== '' && strtotime($row['Time'])> time ())
			{
				echo ''.$row['Username'].' ';
				echo 'Was a very bad sport, ';
			}
			else{
				if($_SESSION['username'] == ''.$row['Username'].'')
			echo '<b> Hi '.$row['FirstName']. ' this is your profile</b> ';
			
			else{
				echo ''.$row['Username']. ' is a loyal '.$row['AccessLevel']. '';
			}
			}
	?>
<table style="overflow-x:auto;" class="table1">
<tr>
	<th>User Information </th>
</tr>

<tr>
<td>
	<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
		if ( ''.$row['Ban'].'' !== '' && $_SESSION['access_level'] == 'Moderator' && $_SESSION['access_level'] == 'Admin' && strtotime($row['Time'])> time ())
			{
				echo '';
			}
			else{
			echo ' <b>Username: ' .$row['Username']. '</b> ';
			}
	?>
<br/>
<br/>
	<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
		if ( ''.$row['Ban'].'' !== '' && $_SESSION['access_level'] !== 'Moderator' && $_SESSION['access_level'] !== 'Admin'&& strtotime($row['Time'])> time ())
			{
				echo '';
			}
			else{
				if(!empty(''.$row['FirstName'].''))
			echo '<b> First Name: '.$row['FirstName']. '</b> ';
			
			else{
				echo 'No First Name';
			}
			}
	?>
<br/>
<br/>
	<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
		if ( ''.$row['Ban'].'' !== '' && $_SESSION['access_level'] !== 'Moderator' && $_SESSION['access_level'] !== 'Admin' && strtotime($row['Time'])> time ())
			{
				echo '';
			}
			else{
				if(!empty(''.$row['LastName'].''))
			echo '<b> Last Name: '.$row['LastName']. '</b> ';
			
			else{
				echo 'No Last Name';
			}
			}
	?>
	
<br/>
<br/>
	<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
		if ( ''.$row['Ban'].'' !== '' && $_SESSION['access_level'] !== 'Moderator' && $_SESSION['access_level'] !== 'Admin' && strtotime($row['Time'])> time ())
			{
				echo '';
			}
			else{
				if(!empty(''.$row['YearOfBirth'].''))
			echo '<b> Year Of Birth: '.$row['YearOfBirth']. '</b> ';
			
			else{
				echo 'No Year Of Birth';
			}
			}
	?>	
<br/>
<br/>
	<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
	if ( ''.$row['Ban'].'' !== '' && $_SESSION['access_level'] !== 'Moderator' && $_SESSION['access_level'] !== 'Admin' && strtotime($row['Time'])> time ())
			{
				echo '';
			}
						else{
				if(!empty(''.$row['Country'].''))
			echo '<b> Country: '.$row['Country']. '</b> ';
			
			else{
				echo 'No Country';
			}
			}
	?>
	<br/>
<br/>
		<?php
		$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
			if (empty($row['Ban']|| $row['Time']))
			{
				echo '<b>Not Banned</b>';
			}
			else{
				if(strtotime($row['Time'])< time ())
					echo '<b>Not Banned</b>';
			else{
			echo '<b> Banned for: '.$row['Ban'].'</b></br>';
			echo '<b> Banned Untill: '.$row['Time'].'</b>';
			}
			}
			
	?>	

	</td>
	
<?php
$oresult = $db->query($query);
		while ($row = $oresult->fetch_assoc())
if ($_SESSION['access_level'] == 'Admin' && $_SESSION['username'] !== ''.$row['Username'].'' &&  strtotime($row['Time'])>time ())
        {
echo '<table><tr>';
echo '</tr>';
{
echo '';
break;
}

echo '</table>';
		}
		
		
		
else if ($_SESSION['access_level'] == 'Admin' && $_SESSION['username'] !== ''.$row['Username'].'' && ''.$row['AccessLevel'].'' ==  'Member' && strtotime($row['Time'])< time ())
        {
echo '<table><tr>';
echo '</tr>';
{
echo '<td><a href="makeAdmin.php?edi_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Admin</a><br/>
	
<a href="makeMOD.php?edit_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Moderator</a></td></tr>';
}

echo '</table>';
		}
		
		
		
else if ($_SESSION['access_level'] == 'Admin' && $_SESSION['username'] !== ''.$row['Username'].'' && ''.$row['AccessLevel'].'' ==  'Admin' )
	
		{
	echo '<table><tr>';
echo '</tr>';
{
echo '<td><a href="makeMember.php?dit_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Member</a><br/>
	
<a href="makeMOD.php?edit_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Moderator</a></td></tr>';
}

echo '</table>';
		}
		
		
 else if ($_SESSION['access_level'] == 'Admin' && $_SESSION['username'] !== ''.$row['Username'].'' && ''.$row['AccessLevel'].'' ==  'Moderator' )
        {
echo '<table><tr>';
echo '</tr>';
{
echo '<td><a href="makeMember.php?dit_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Member</a><br/>
	
<a href="makeAdmin.php?edi_id='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Edit this user ' .$row['Username']. ' ?\');">Make this user an Admin</a><br/></td></tr>';
}

echo '</table>';
		}
		
		?>
		
		
		
		
<?php
$oresult = $db->query($query);
	while ($row = $oresult->fetch_assoc())
		
 if ($_SESSION['access_level'] == 'Moderator' && $_SESSION['username'] !== ''.$row['Username'].'' && ''.$row['AccessLevel'].'' ==  'Member' && strtotime($row['Time'])< time ())
		 {
echo '<table><tr>';
echo '</tr>';
{
echo '<td><a href="Ban.php?eid='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Ban ' .$row['Username']. ' ?\');">Ban This Person</a></td></tr>';
}
echo '</table>';
		}
		
else if(strtotime($row['Time'])> time () && $_SESSION['access_level'] == 'Moderator')
			{
		echo '<br/><a href="unban.php?eid='.$row['UserID'].'" 
	onclick="return confirm(\'Are you sure that you want to Ban ' .$row['Username']. ' ?\');">Would you like to Unban ' .$row['Username']. ' </a>';
		}
	
		
	
?>
</tr>
</table>

</form>
</body>
</html>