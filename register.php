<!DOCTYPE html>

<html>
<head>
  <title>User Registration Form</title>
  <script language="JavaScript" type="text/javascript">
	
	function ValidateForm()
		{
			if (document.newMemberForm.username.value == '')
			{
				alert('Username field cannot be left blank. ');
				document.newMemberForm.username.focus();
				return false
			}
			
			else if (document.newMemberForm.emailAddress.value == '')
			{
				alert('Email Address field cannot be left blank. ');
				document.newMemberForm.emailAddress.focus();
				return false;
			}
			
			else if (document.newMemberForm.yearOfBirth.length > 4)
			{
				alert('Year of birth must have correct format (YYYY). ');
				return false;
			}
			
			else if (document.newMemberForm.yearOfBirth.value == '')
			{
				alert('Year Of birth is empty ');
				return false;
			}
			
			else if (document.newMemberForm.yearOfBirth.value.isNaN)
			{
				alert('Year of birth must be numerical. ');
				return false;
			}
			
			else if (document.newMemberForm.password.value == '')
			{
				alert('Password field cannot be left blank. ');
				document.newMemberForm.password.focus();
				return false;
			}
			
			else if (document.newMemberForm.password.value.length < 5)
			{
				alert('Password must be atleast 5 characters long.');
				document.newMemberForm.password.focus();
				return false;
			}
			
			else if (document.newMemberForm.confirmPassword.value == '')
			{
				alert('Confirm Password field cannot be left blank. ');
				document.newMemberForm.confirmPassword.focus();
				return false;
			}
			
			else if (document.newMemberForm.password.value != document.newMemberForm.confirmPassword.value)
			{
				alert('Password fields do not match.');
				document.newMemberForm.confirmPassword.focus();
				return false;
			}
			
			return true;
		}
  
  </script>
  <link rel="stylesheet" type="text/css" href="mycss2.css"/>
</head>

<?php

	@ $db = new mysqli('localhost', 'root', '', 'website');
	
	if (mysqli_connect_error())
	{
		echo 'Error connecting to database:<br />'.mysqli_connect_error();
		exit;
		
	}
?>

<body>
<header>
	<h1>MovieMadness</h1>
</header>
</div>

<div class="topnav">
	<a href="homepage.php">Home</a>
	<a class="active" href="register.php">Register</a>
	<a href="signIn.php">Sign In</a>
</div>

<h2><strong>Member Registration Form</strong></h2>
<form name="newMemberForm" method="post" onsubmit="return  ValidateForm();" action="registerMember.php">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Username</td>
      <td> 
        <input name="username" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <input name="firstname" type="text" style="width: 200px;" maxlength="100" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <input name="surname" type="text" style="width: 200px;" maxlength="100" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <input name="emailAddress" type="text" style="width: 200px;" maxlength="200" />*</td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Year of Birth</td>
      <td> 
        <input name="yearOfBirth" type="text" style="width: 200px;" maxlength="4" />*</td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Country of Residence</td>
      <td> 
        <input name="country" type="text" style="width: 200px;" maxlength="10" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 200px;" maxlength="20" />*</td>
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
		<input type="submit" name="submit" value="Submit" /></td>
      <td> 
        <div align="right">* indicates required field</div></td>
    </tr>
  </table>
</form>
</body>
</html>
