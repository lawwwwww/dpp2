var gErrorMsg="";

function validateForm()
{

	var isAllOK=false;
	gErrorMsg="";
	var nameOK=name();
	var dateOK=isDateOK();
	var timeOK=time();
	if(nameOK&&timeOK&&dateOK)
	{
		isAllOK=true;
	}
	else
	{
		alert(gErrorMsg);
		gErrorMsg="";
		isAllOK=false;
	}
	return isAllOK;
	
}

function name()
{
	var name = document.getElementById("name").value;
	var pattern = /^[a-zA-Z]+$/ ;   //check only alpha characters or space  
	var result = true;
	if (name.length == 0)
	{       
		gErrorMsg = gErrorMsg + "Name cannot be blank.\n";
		result = false; 
	}

	
	return result;
}

function isDateOK()
{
	var validDate=true;
	var date=document.getElementById("preferday").value;
	var now=new Date();
	var today=now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate();
	
	if(date.length==0)
	{
		gErrorMsg=gErrorMsg+"Date cannot be blank.\n";
		validDate=false;
	}
	else{
	if(today>date)
	{
		gErrorMsg=gErrorMsg+"Date should be current or future date.\n";
		validDate=false;
	}
	}

	return validDate;
}

function time()
{
	var time=document.getElementById("time").value;
	var date=document.getElementById("preferday").value;
	var now=new Date();
	var today=now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate();
	var tnow=now.getHours()+':'+now.getMinutes();
	
	
	var timeOk=true;
	if(time.length==0)
	{
		gErrorMsg=gErrorMsg+"Time cannot be blank.\n";
		timeOk=false;
	}
	else
	{
		if(date==today && tnow>time)
		{
			gErrorMsg=gErrorMsg+"Time should be current or future time.\n";
			timeOk=false;
		}
	}
	
	return timeOk;
}
	
function init()
{
		var form=document.getElementById("form");
		form.onsubmit=validateForm;
}
	
	window.onload=init;