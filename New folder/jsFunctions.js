function throttle()
{
	document.getElementById("submit").disabled = true; 	
}
function timeoutSubmit() 
{
	setTimeout('document.getElementById("query").disabled = false;', 10000);
	setTimeout('document.getElementById("submit").disabled = false;', 10000);
 
}
function showGoogle()
{
	window.page = 0;
	window.engine = 0;
	$("#clusterOptions").fadeOut("fast");
	$("#resultsStrings").fadeOut("fast");
	$("#bottomBar").fadeIn("fast");
	document.getElementById("resultsStrings").innerHTML= googleResults[0];
	$("#resultsStrings").fadeIn();
	
}
function showBlekko()
{
	window.page = 0;
	window.engine = 1;
	$("#clusterOptions").fadeOut("fast");
	$("#resultsStrings").fadeOut("fast");
	$("#bottomBar").fadeIn("fast");
	document.getElementById("resultsStrings").innerHTML= blekkoResults[0];
	$("#resultsStrings").fadeIn();
}
function showBing()
{
	window.page = 0;
	window.engine = 2
	$("#clusterOptions").fadeOut("fast");	
	$("#resultsStrings").fadeOut("fast");
	$("#bottomBar").fadeIn("fast");
	document.getElementById("resultsStrings").innerHTML= bingResults[0];
	$("#resultsStrings").fadeIn();
}
function showBlingo()
{
	window.page = 0;
	window.engine = 3;
	$("#clusterOptions").fadeIn("fast");
	$("#resultsStrings").fadeOut("fast");
	$("#bottomBar").fadeIn("fast");
	document.getElementById("resultsStrings").innerHTML= blingoResults[0];
	$("#resultsStrings").fadeIn();
}
function showCluster(index)
{
	$('html, body').animate({ scrollTop: 0 }, 'slow');
	$("#bottomBar").fadeOut("fast");
	$("#resultsStrings").fadeOut("fast");
	document.getElementById("resultsStrings").innerHTML= clusterResults[index];	
	$("#resultsStrings").fadeIn();
}
function prevPage(engine, page)
{
	if (page == 0)
	{
		alert("You are on Page 1\nThere are no Previous Pages");
		return;
	}
	switch (engine)
	{
		case 0:
		  $("#resultsStrings").fadeOut("fast");
  		  document.getElementById("resultsStrings").innerHTML= window.googleResults[page -1];
  		  $("#resultsStrings").fadeIn();
		  window.page--;
		  break;
		case 1:
  		  $("#resultsStrings").fadeOut("fast");
		  document.getElementById("resultsStrings").innerHTML= window.blekkoResults[page -1];
  		  $("#resultsStrings").fadeIn();
		  window.page--;
		  break;
		case 2:
  		  $("#resultsStrings").fadeOut("fast");
		  document.getElementById("resultsStrings").innerHTML= window.bingResults[page -1];
  		  $("#resultsStrings").fadeIn();
		  window.page--;
		  break;
		case 3:
  		  $("#resultsStrings").fadeOut("fast");
		  document.getElementById("resultsStrings").innerHTML= window.blingoResults[page -1];
  		  $("#resultsStrings").fadeIn();
		  window.page--;
		  break;
	}
	$('html, body').animate({ scrollTop: 0 }, 'fast');
	return;
}
function nextPage(engine, page)
{
	switch(engine)
	{
		case 0:
			if(googleResults[page +1])
			{
				$("#resultsStrings").fadeOut("fast");
				document.getElementById("resultsStrings").innerHTML= window.googleResults[page +1];
				$("#resultsStrings").fadeIn();
			}
			else
				alert("You are on the last page. There are no more!");
			window.page++;
			break;
		case 1:
			if(blekkoResults[page +1])
			{
				$("#resultsStrings").fadeOut("fast");
				document.getElementById("resultsStrings").innerHTML= window.blekkoResults[page +1];
				$("#resultsStrings").fadeIn();
			}
			else
				alert("You are on the last page. There are no more!");
			window.page++
			break;
		case 2:
			if(bingResults[page +1])
			{	
				$("#resultsStrings").fadeOut("fast");
				document.getElementById("resultsStrings").innerHTML= window.bingResults[page +1];
				$("#resultsStrings").fadeIn();
			}
			else
				alert("You are on the last page. There are no more!");
			window.page++;
			break;
		case 3:
			if(blingoResults[page +1])
			{
				$("#resultsStrings").fadeOut("fast");
				document.getElementById("resultsStrings").innerHTML= window.blingoResults[page +1];
				$("#resultsStrings").fadeIn();
			}
			else
				alert("You are on the last page. There are no more!");
			window.page++;
			break;
	}
	$('html, body').animate({ scrollTop: 0 }, 'slow');
	return;
}