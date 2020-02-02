function passwordShow()
{
	var types= document.getElementById('password');

	if (types.type=="password") 
	{
		types.type="text";
		document.getElementById('show').innerText="hide";

		}
	else
	{
		types.type="password";
		document.getElementById('show').innerText="show";
		
	}

}