<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blingo Metasearch Engine Testing</title>
<link href="blingostyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include("functions.php"); // include the file functions.php which contains various functions to be used in the page
include("main.php"); // include the file main.php which creates all the variables to be output on this page, i.e. the results
?>
<div id="wrapper"> 
  <div id="navigation">
    <ul id="menu-bar">
    <li class="active"><a href="#">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="feedback.php">Feedback</a></li>
    </ul>
  </div>
  <div id="outerlogo">
    <div id="resultslogo"><img src="images/logo.png" width="400" height="104" alt="Blingo Logo" /></div>
    <div id ="resultsform">
    <form method="POST" action="testing.php"><br />
        <input name="query" type="text" size="50" maxlength="60" value="" />
        <input name="qid" type="text" size="5" maxlength="5" value="" />
        <input name="bt_search" type="submit" value="Search" /><br/>
        <label for="preprocessing">Query Preprocessing: </label>
        <input name="preprocessing" type="radio" value="on" checked /> On
        <input name="preprocessing" type="radio" value="off" /> Off <br />
        <label for="clustering">Clustering: </label>
        <input name="clustering" type="radio" value="on" /> On
        <input name="clustering" type="radio" value="off" checked  /> Off <br />
      </form> 
    </div>
  </div>
  <div id="body">Test Data Gathering Page</div>
</div>
<?php
if (isset($_POST['query']))
{
$filename = 'goldstandard.txt';						// name of goldstandard file
$textFile = file($filename, FILE_IGNORE_NEW_LINES);	// read file into an array $textfile, each line a new element
$goldStandard = array();							// declare the array to hold the gold standard
$i = 0;												// counter for url
foreach($textFile as $result)						// iterate through the raw array
{
	$index = intval(substr($result, 0, 3));			// parse the index and change to an integer(first 3 chars on each line)
	$url = standardiseUrls(substr($result, 4));		// and the url (from char 4 to the end of the line)
	$goldStandard[$index][$i] = $url;				// $index changes for esch query, $i changes for each url
	$i++;											// increment the counter
	if ($i%100 == 0)								// back to 0 after every 100 (new query)
		$i = 0;
}
$googleTotal = sizeof($googleArray);
$blekkoTotal = sizeof($blekkoArray);
$bingTotal = sizeof($bingArray);
$blingoTotal = sizeof($blingoArray);			// total results returned from each
$googleMatches = 0;
$blekkoMatches = 0;
$bingMatches = 0;
$blingoMatches = 0;								// total relevent documents returned
$googleAtTen = 0;
$blekkoAtTen = 0;
$bingAtTen = 0;
$blingoAtTen = 0;								// total relevent documents within the first 10 results
$googleAP = array();
$blekkoAP = array();
$bingAP = array();
$blingoAP = array();							// array of positons of the matches (used in Average Precision)
$output = '';									// string to hold the output to be written to the file
if (isset($_POST['qid']))						// if qid is set form form (query ID/index)
	$q = $_POST['qid'];
else											// wont be set on the first query i.e. 151
	$q = 151;			
	
foreach($googleArray as $index => $result)		// iterate through each result from google
{
	foreach	($goldStandard[$q] as $url)		// iterate through each url for the query (index)
	{
		if ($result[4] == $url)				// if the urls match
		{
			$googleMatches++;					// increment the counter
			$googleAP[] = $index + 1;			// add the position of the match to the GoogleAP array
			if ($index < 10)					// if a match within the first 10 results
				$googleAtTen++;					// increment the googl @10 counter
			break;								// if it matches once break the inner loop(duplicate entries in goldstandard)
		}
	}
}
$sumOfPrecision = 0;								// will be used to calculate Average Precision
foreach($googleAP as $index => $recallPoint)		// calculate the precision at each recall point
{
	$precision = ($index+1)/$recallPoint;			// number of relevant documents/total retrieved documents
	$sumOfPrecision += $precision;					// add to sum of precision
}
$googleAveragePrecision = $sumOfPrecision/100;		// calculate the Average Precision
$googleRecall = $googleMatches/100;					// number of relevant docs/total relevant docs
$googleAtTen = $googleAtTen/10;						// no of relevent docs retieved in first 10 results/10
$googlePrecision = $googleMatches/$googleTotal;		// numger of relevant docs/toal retrieved docs
$googleFMeasure = (2 * $googlePrecision * $googleRecall)/($googlePrecision + $googleRecall);	// 2PR/P+R

foreach($blekkoArray as $index => $result)
{
	foreach	($goldStandard[$q] as $url)
	{
		if ($result[4] == $url)
		{
			$blekkoMatches++;
			$blekkoAP[] = $index + 1;
			if ($index < 10)
				$blekkoAtTen++;
			break;
		}
	}
}
$sumOfPrecision = 0;								// will be used to calculate Average Precision
foreach($blekkoAP as $index => $recallPoint)
{
	$precision = ($index+1)/$recallPoint;			// number of relevant documents/total retrieved documents
	$sumOfPrecision += $precision;					// add to sum of precision
}
$blekkoAveragePrecision = $sumOfPrecision/100;		// calculate the Average Precision
$blekkoRecall = $blekkoMatches/100;
$blekkoAtTen = $blekkoAtTen/10;
$blekkoPrecision = $blekkoMatches/$blekkoTotal;
$blekkoFMeasure = (2 * $blekkoPrecision * $blekkoRecall)/($blekkoPrecision + $blekkoRecall);

foreach($bingArray as $index => $result)
{
	foreach	($goldStandard[$q] as $url)
	{
		if ($result[4] == $url)
		{
			$bingMatches++;
			$bingAP[] = $index + 1;
			if ($index < 10)
				$bingAtTen++;
			break;
		}
	}
}
$sumOfPrecision = 0;								// will be used to calculate Average Precision
foreach($bingAP as $index => $recallPoint)
{
	$precision = ($index+1)/$recallPoint;			// number of relevant documents/total retrieved documents
	$sumOfPrecision += $precision;					// add to sum of precision
}
$bingAveragePrecision = $sumOfPrecision/100;		// calculate the Average Precision
$bingRecall = $bingMatches/100;
$bingAtTen = $bingAtTen/10;
$bingPrecision = $bingMatches/$bingTotal;
$bingFMeasure = (2 * $bingPrecision * $bingRecall)/($bingPrecision + $bingRecall);

foreach($blingoArray as $index => $result)
{
	foreach	($goldStandard[$q] as $url)
	{
		if ($result[4] == $url)
		{
			$blingoMatches++;
			$blingoAP[] = $index + 1;
			if ($index < 10)
				$blingoAtTen++;
			break;
		}
	}
}
$sumOfPrecision = 0;								// will be used to calculate Average Precision
foreach($blingoAP as $index => $recallPoint)
{
	$precision = ($index+1)/$recallPoint;			// number of relevant documents/total retrieved documents
	$sumOfPrecision += $precision;					// add to sum of precision
}
$blingoAveragePrecision = $sumOfPrecision/100;
$blingoRecall = $blingoMatches/100;
$blingoAtTen = $blingoAtTen/10;
$blingoPrecision = $blingoMatches/$blingoTotal;
$blingoFMeasure = (2 * $blingoPrecision * $blingoRecall)/($blingoPrecision + $blingoRecall);

$googlePStr = print_r($googleAP, true);				// print the arrays into a variable
$blekkoPStr = print_r($blekkoAP, true);				// so they can be output to a file
$bingPStr = print_r($bingAP,true);
$blingoPStr = print_r($blingoAP, true);

$output = 											// create a string with the results in it

"\nQuery = {$q}
Google Total = {$googleTotal}
Google Recall = {$googleRecall}
Google Precision = {$googlePrecision}
Google F-Measure = {$googleFMeasure}
Google 10 = {$googleAtTen}
Google Average Precision = {$googleAveragePrecision}\n
Blekko Total = {$blekkoTotal}
Blekko Recall = {$blekkoRecall}
Blekko Precision = {$blekkoPrecision}
Blekko F-Measure = {$blekkoFMeasure}
Blekko 10 = {$blekkoAtTen}
Blekko Average Precision = {$blekkoAveragePrecision}\n
Bing Total = {$bingTotal}
Bing Recall = {$bingRecall}
Bing Precision = {$bingPrecision}
Bing F-Measure = {$bingFMeasure}
Bing 10 = {$bingAtTen}
Bing Average Precision = {$bingAveragePrecision}\n
Blingo Total = {$blingoTotal}
Blingo Recall = {$blingoRecall}
Blingo Precision = {$blingoPrecision}
Blingo F-Measure = {$blingoFMeasure}
Blingo 10 = {$blingoAtTen}
Blingo Average Precision = {$blingoAveragePrecision}\n
\n***********************************************************************************************************************\n";

$outFile = 'results.txt';		// name of the file to output to
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($outFile, $output, FILE_APPEND | LOCK_EX);		// write $output string to the $outfile
echo("<p>The results have been appended to {$outFile}</p>");
}
?>
</body>
</html>