<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blingo Metasearch Engine Results</title>
<link href="blingostyle.css" rel="stylesheet" type="text/css" />	<!-- link the css stylesheet -->
<script src="jsFunctions.js"></script>								<!-- link the javascript functions file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> <!-- link jquery -->
<script> timeoutSubmit();</script>				<!-- function to disable submit button for 10 seconds on loading page -->
</head>
<body>
<?php
include("functions.php"); // include the file functions.php which contains various functions to be used in the page
include("main.php"); // include the file main.php which creates all the variables to be output on this page, i.e. the results
if (isset($_POST['query']))							// if the data has been sent to the server
{
	echo "<script>\n";								// open javascript tag
	echo "var googleResults = new Array();\n";		// declare variables to hold the results string arrays
	echo "var blekkoResults = new Array();\n";		// for all
	echo "var bingResults = new Array();\n";		// 4 
	echo "var blingoResults = new Array();\n";		// results sets
	echo "var engine = 3;\n";		// variable to store the current engine
	echo "var page = 0;\n";			// variable to sotre the page number
	
	if(isset($googleResultsStr[0]))					// check to see that the results set exists and no errors have occured
		foreach ($googleResultsStr as $page)		// loop through the results array 
		{
			echo "googleResults.push(".json_encode($page).");\n";	// push each string to the end of the javascript array
		}
	if(isset($blekkoResultsStr[0]))					// do the same for all 4 results strings
		foreach ($blekkoResultsStr as $page)
		{
		echo "blekkoResults.push(".json_encode($page).");\n";
		}
	if(isset($bingResultsStr[0]))
		foreach ($bingResultsStr as $page)
		{
		echo "bingResults.push(".json_encode($page).");\n";
		}
	if(isset($blingoResultsStr[0]))
		foreach($blingoResultsStr as $page)
		{
		echo "blingoResults.push(".json_encode($page).");\n";
		}
	echo "</script>";								// close the script tag, the results strings are now stoered as js variables
}
if($_POST['clustering'] == 'on')
{						// if clustering is turned on
	echo "<script>";
	echo "var clusterResults = new Array();\n";			// initialise variable to hold cluster result strings
	if(isset($clusterResultsStr[0]))
	{
		ksort($clusterResultsStr);						// make sure the results are sorted properly
		foreach($clusterResultsStr as $cluster)			// for each results string starting at 0
		{
			echo "clusterResults.push(".json_encode($cluster).")\n";	// store the string in the next place of the javascript
			}															// variable. json_encode looks after escaping " and other
	}																	// special characters
	echo "</script>";
}
?>
<div id="wrapper"> 
  <div id="navigation">
    <ul id="menu-bar">
    <li class="active"><a href="blingo.html">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="feedback.php">Feedback</a></li>
    </ul>
  </div>
  <div id="outerlogo">
    <div id="resultslogo"><img src="images/logo.png" width="400" height="104" alt="Blingo Logo" /></div>
    <div id ="resultsform">
    <form method="POST" action="blingo.php" onsubmit="throttle()"><br />
      <input id="query" name="query" type="text" size="50" maxlength="60" value="<?php echo $_POST['query'];?>" disabled />
      <input id ="submit" name="submit" type="submit" value="Search" disabled="true"/><br/>
      <label for="preprocessing">Query Preprocessing: </label>
      <input name="preprocessing" type="radio" value="on" <?php if($_POST['preprocessing']=='on') echo " checked";?>/> On
      <input name="preprocessing" type="radio" value="off"<?php if($_POST['preprocessing']=='off') echo " checked";?>/> Off <br />
      <label for="clustering">Clustering: </label>
      <input name="clustering" type="radio" value="on" <?php if($_POST['clustering'] == 'on') echo " checked";?> /> On
      <input name="clustering" type="radio" value="off"<?php if($_POST['clustering'] == 'off') echo " checked";?> /> Off <br />
    </form> 
    </div>
  </div>

  <div id="body">
    <div id = "outerOptionsBar">
      <div id="resultsOptionsBar">
        <button onclick="showBlingo()"><img src="images/blingoButton.png" width="100" height="42" alt="Blingo Button" /></button>
        <button onclick="showGoogle()"><img src="images/googleButton.png" width="100" height="42" alt="Google Button" /></button>
        <button onclick="showBing()"><img src="images/bingButton.png" width="100" height="42" alt="Bing Button" /></button>
        <button onclick="showBlekko()"><img src="images/blekkoButton.png" width="100" height="42" alt="Blekko Button" /></button>
      </div>
    </div>
    <div id = "results">
      <?php
		if ($_POST['clustering'] == 'on')				// if clustering is turned on
		{
			echo "<div id=\"clusterOptions\">";			// create a div to hold the buttons
			echo "<p>Categories</> <br />";
			for($i=0; $i<sizeof($clusterNames); $i++)	// for each cluster category
			{											// create a button which when pressed will call the showCluster
				echo "<button onclick=\"showCluster($i)\">$clusterNames[$i]</button><br />";	// javascript function
			}
			echo "</div>";
		}
	  ?>
      <div id="resultsStrings"></div>
      <script>showBlingo();</script>					<!-- call function to show first page of blingo by default -->
      <div id="bottomBar">
        <button id="previousPage" onclick="prevPage(engine, page)"><strong>&lt;Prev Page</strong></button>
        <button id="nextPage" onclick="nextPage(engine, page)"><strong>Next Page&gt;</strong></button>
      </div>
    </div>
  </div>
</div>
</body>
</html>