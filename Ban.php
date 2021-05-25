<?php

	session_start();

	if (!isset($_SESSION['username']) || $_SESSION['access_level'] != 'Moderator' )
	{
		header('Location: signIn.php');
	}

	else
		
		echo '<header><h1>MovieMadness</h1></header>';
		echo '<div class="topnav">
			<a href="homepage.php">Home</a>
			<a href="movieinput.php">Add Movie</a>
			<a class="active" href="listMembers.php">List Members</a>
			<a href="logout.php" style="float:right">Log Out</a>
			</div>';
		
	@ $db = new mysqli('localhost', 'root', '', 'website');
	if (mysqli_connect_error())
	{
		echo 'error: <br/>'.mysqli_connect_error();
		exit;
	}
	
	
	if (isset($_POST['submit']))
	{
		
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$surname = $_POST['surname'];
			$emailAddress = $_POST['emailAddress'];
			$Time = $_POST['Time'];
			$yearOfBirth = $_POST['yearOfBirth'];
			$country = $_POST['country'];
			$password = $_POST['password']; 
			$Ban = $_POST['Ban']; 
			$AccessLevel=$_POST['AccessLevel'];
			$confirmPassword = $_POST['confirmPassword'];
		
	
	
		$error_message = '';
		
	
		if (empty($Ban) || empty($Time) || empty($username) || empty($emailAddress) || (empty($yearOfBirth) || empty($password) || empty($confirmPassword)))
		{
		$error_message = 'One of the required fields was left blank.';
		}
		
	
		if (!is_numeric($yearOfBirth))
		{
			$error_message = 'Your year of birth is not numeric.';
		}
		
		if (!is_numeric($Time))
		{
			$error_message = 'Time is not numeric.';
		}
		
		if (strlen($yearOfBirth) != 4)
		{
			$error_message = 'Your year of birth is not in the correct format.';
		}
		
	
		if (strlen($password) < 5)
		{
			$error_message = 'Your password is not long enough.';
		}
		
	
		if ($password != $confirmPassword)
		{
			$error_message = 'Your passwords do not match.';
		}
		if ($_SESSION['username'] == $username)
			{
				$error_message = ''.$username.' Sorry you can not Ban youself';
			}
			
			if ($_SESSION['username'] == $username)
			{
				$error_message = ''.$username.' Sorry you can not Ban youself';
			}
			if ($AccessLevel == 'Admin')
			{
				$error_message = ''.$username.' Sorry you can not Ban Admins';
			}
			
				if ($error_message != '')
		{
			echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
			echo '</body></html>';
			exit;
		}

		$HA ="SELECT * FROM memberdetails WHERE Username = '".$_SESSION['username']."'";
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
	if(''.$row['AccessLevel'].'' !== 'Moderator')
	{
		
		header("Location: Logout.php");
		exit();
	} 
	
		else
		{
			$query = "UPDATE memberdetails SET FirstName = '".$firstname."', LastName = '".$surname."', Username = '".$username."', EmailAddress = '".$emailAddress."', 
			YearOfBirth = '".$yearOfBirth."', Country = '".$country."',Password = '".$password."',AccessLevel = '".$AccessLevel."', Ban='".$Ban."',Time = DATE_ADD(NOW(), INTERVAL '".$Time."' HOUR)
			WHERE UserID = ".$_GET['eid'];
			
			$result = $db->query($query);
			
			if ($result)
			{
				header("Location: homepage.php");
				exit;
			}
			else
			{
				
				echo '<p>Error updating details. Error message:</p>';
				echo'<p>'.$db->error.'</p>';
			}
		}
	}

	
			$query = 'SELECT * FROM memberdetails WHERE UserID = '.$_GET['eid'];
			$result = $db->query($query);
			$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Member Form</title>
  <link rel="stylesheet" type="text/css" href="mycss2.css"/>
   <script src="errors.js"></script> 
</head>

<body>
<form name="rate20" method="post" onsubmit="return rate109();">
  <table>
      <tr><td> 
        <input name="firstname" type="hidden" style="width: 200px;" maxlength="100" value="<?php echo $row['FirstName']; ?>" />
        <input name="surname" type="hidden" style="width: 200px;" maxlength="100" value="<?php echo $row['LastName']; ?>" />
		<select name="username"><option><?php echo $row['Username']; ?></option></select>
        <input name="Ban" type="text" style="width: 200px;" maxlength="100" placeholder="Ban reason" />
        <input name="Time" type="text" style="width: 200px;" maxlength="2" placeholder="Length of ban"/>
        <input name="emailAddress" type="hidden" style="width: 200px;" maxlength="200" value="<?php echo $row['EmailAddress']; ?>" />
        <input name="yearOfBirth" type="hidden" style="width: 100px;" maxlength="10" value="<?php echo $row['YearOfBirth']; ?>" />
        <input name="country" type="hidden" style="width: 100px;" maxlength="10" value="<?php echo $row['Country']; ?>" />
        <input name="AccessLevel" type="hidden" style="width: 200px;" value="<?php echo $row['AccessLevel']; ?>" />
        <input name="password" type="hidden" style="width: 200px;" value="<?php echo $row['Password']; ?>" />
        <input name="confirmPassword" type="hidden" style="width: 200px;" value="<?php echo $row['Password']; ?>" />

		<input type="submit" name="submit" value="Ban Member" /></td>
    </tr>
  </table>
</form>
</body>
</html>

