var checkflag = "false";
function check()
{
	var attribute = document.getElementsByName('selector[]');
	if(checkflag =="false")
	{
		for(i=0;i<attribute.length; i++)
		{			
		   attribute[i].checked = true;
		}
	
	checkflag="true";
	//return "Check All";
    }
    else
      {
		for(i=0;i<attribute.length; i++)
		{
			attribute[i].checked = false;
		}
		checkflag = "false";
		//return "Uncheck All";
    } 
}