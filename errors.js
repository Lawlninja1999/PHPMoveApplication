function rate108(){
	if (document.rate20.comment.value == "")
	{
		alert('Please Write A Comment');
		return false;
	}
	if (document.rate20.Ban.value == "")
	{
		alert('Please Write A Comment');
		return false;
	}
	if (document.rate20.Time.value == "")
	{
		alert('Please Write A Comment');
		return false;
	}
}

function rate109(){
	if (document.rate20.Ban.value == "")
	{
		alert('Ban reason is empty');
		return false;
	}
	if (document.rate20.AccessLevel.value == "Admin")
	{
		alert('Admins can not be banned');
		return false;
	}
		if (document.rate20.AccessLevel.value == "Moderator")
	{
		alert('Moderators can not be banned');
		return false;
	}
	if (document.rate20.Time.value == "")
	{
		alert('Length of ban is empty');
		return false;
	}
	if (isNaN(document.rate20.Time.value))
	{
		alert('Length of ban is not a number');
		return false;
	}
}

function form101(){
	
	if (document.form1.movieName.value == "")
	{
		alert('Enter a movie name');
		return false;
	}
	if (document.form1.Date.value == "")
	{
		alert('Enter a Year Of Release');
		return false;
	}
	if (isNaN(document.form1.Date.value))
	{
		alert('Date of Release is not a Number');
		return false;
	}
	if (document.form1.Date.value.length > 4 )
	{
		alert('Date is too long');
		return false;
	}
	if (document.form1.Date.value.length < 4 )
	{
		alert('Date must be 4 digits');
		return false;
	}
	if (document.form1.Duration.value.length < 3 )
	{
		alert('Duration must be 3 digits');
		return false;
	}
	if (document.form1.Director.value == "")
	{
		alert('Enter a Director Name');
		return false;
	}
	if (document.form1.Writers.value == "")
	{
		alert('Enter a Writer name');
		return false;
	}
	
	if (document.form1.Duration.value == "")
	{
		alert('Enter The Movie Length');
		return false;
	}
	if (document.form1.Duration.value.length > 4)
	{
		alert('Duration is too long');
		return false;
	}
	if (isNaN(document.form1.Duration.value))
	{
		alert('Duration is not a number');
		return false;
	}
}


