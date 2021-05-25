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
			<a class="active" href="editProfile.php" style="float:right">Edit Profile</a>
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
			<a class="active" href="editProfile.php" style="float:right">Edit Profile</a>
			</div>';
	}
		
	@ $db = new mysqli('localhost', 'root', '', 'website');
	if (mysqli_connect_error())
	{
		echo 'error: <br/>'.mysqli_connect_error();
		exit;
	}
	

	if (isset($_POST['firstname']))
	{

			$firstname = $_POST['firstname'];
			$surname = $_POST['surname'];
			$emailAddress = $_POST['emailAddress'];
			$yearOfBirth = $_POST['yearOfBirth'];
			$country = $_POST['country'];
			$password = $_POST['password']; 
			$confirmPassword = $_POST['confirmPassword'];
		
	
		$error_message = '';
		
	
		if (empty($emailAddress) || (empty($yearOfBirth) || empty($password) || empty($confirmPassword)))
		{
		$error_message = 'One of the required fields was left blank.';
		}
		

		if (!is_numeric($yearOfBirth))
		{
			$error_message = 'Your year of birth is not numeric.';
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

		if ($error_message != '')
		{

			echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
			echo '</body></html>';
			exit;
		}
		$HA ="SELECT * FROM memberdetails WHERE Username = '".$_SESSION['username']."'";
	$HO=$db->query($HA);
while ($row = $HO->fetch_assoc())
if (strtotime($row['Time'])> time ())
	{
		echo 'You cant Rate';
		header("Location: Logout.php");
		exit();
	}
		else
		{
			$query = "UPDATE memberdetails SET FirstName = '".$firstname."', LastName = '".$surname."', Username = '".$_SESSION['username']."', EmailAddress = '".$emailAddress."', 
			YearOfBirth = '".$yearOfBirth."', Country = '".$country."',Password = '".$password."' WHERE Username = '".$_SESSION['username']."'";
			
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
	
		if (isset($_SESSION['username']))
		{
		
			$query = "SELECT * FROM memberdetails WHERE Username = '".$_SESSION['username']."'";
			$result = $db->query($query);
			$row = $result->fetch_assoc();
			
		}
		else
		{
			
			header('Location: homepage.php');
			exit;
		}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Member Form</title>
  <link rel="stylesheet" type="text/css" href="mycss2.css">
</head>

<body>
<h2><strong>User Details</strong></h2>
<form name="editMemberForm" method="post" action="editProfile.php?">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
	 <tr style="background-color: #FFFFFF;"> 
      <td>Username</td>
      <td><?php echo $row['Username']; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <input name="firstname" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row['FirstName']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <input name="surname" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row['LastName']; ?>" />*</td>
    </tr>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <input name="emailAddress" type="text" style="width: 200px;" maxlength="200" value="<?php echo $row['EmailAddress']; ?>" />*</td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Year of Birth</td>
      <td> 
        <input name="yearOfBirth" type="text" style="width: 100px;" maxlength="10" value="<?php echo $row['YearOfBirth']; ?>" /></td>
    </tr>
		<tr style="background-color: #FFFFFF;"> 
      <td>Country</td>
      <td> 
        <input name="country" type="text" style="width: 100px;" maxlength="10" value="<?php echo $row['Country']; ?>" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td>
        <input name="password" type="password" style="width: 200px;" maxlength="20" value="<?php echo $row['Password']; ?>"/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20" />*</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td> 
        <input type="reset" name="reset" value="Reset" />
		<input type="submit" name="submit" value="Submit" />
		<input type="button" value="Back" onclick="window.history.back()" />
      <td> 
        <div align="right">* indicates required field</div></td>
    </tr>
  </table>
</form>
</body>
</html>
