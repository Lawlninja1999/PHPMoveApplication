<form method="post" action="example.php">
	Name: <input type="text" name="name" /><br />
	Tick Me: <input type="checkbox" name="box" /><br />
	<input type="submit">
</form>

<?php
if (isset($_POST['name']))
{
	echo '<p>The text field contains: ' . $_POST['name'] . '</p>';


	if (isset($_POST['box']))
	{
		echo '<p>The checkbox was ticked!</p>';
	}
	else
	{
		echo '<p>The checkbox was not ticked.</p>';
	}
}
?>