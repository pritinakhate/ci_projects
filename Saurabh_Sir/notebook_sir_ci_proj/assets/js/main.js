var checkflag = "false";
function check()
{
	 var field = document.getElementsByName('selector[]');
	if(checkflag == "false")
	{
		for(i = 0;i < field.length; i++)
		{
			 field[i].checked = true;
		}
		checkflag="true";
		return "Check All";
	}
	else
	{
		for(i=0 ;i < field.length; i++)
		{
			field[i].checked = false;
		}
		checkflag = "false";
		return "Uncheck All";
	} 
}		

