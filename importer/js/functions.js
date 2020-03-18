function askpassword(checkwith)
{

	//DAPAT ADD UG GLOBAL NGA VARIABLE NGA MAG CHECK PARA MAS EFFIENCE EX. let able = false;
	if (!able) 
	{
		
		let confirm= prompt('Enter password: ',``);
		if (confirm==null) 
		{
			return false;
		}
		else
		{
			while(confirm!=checkwith)
			{
				  confirm= prompt('Enter password: ',``);
				  if(confirm==null)
				  {
				  	break;
				  }
			}
			if (confirm==checkwith) 
			{
				  able=true;
				  return true;

				
			}
		}
		
	}
}