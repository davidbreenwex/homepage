<?php
if (isset($_POST['query']))
{
	
	$googleWeighting = 1;					// set the weighting for each search enging
	$blekkoWeighting = 1;
	$bingWeighting = 1;	
	$query = $_POST['query'];
	$blekkoQuery = "";
	$bingQuery = "";

	if ($_POST['preprocessing'] == "on")	// if preprocessing is turned on
		$query = removeStopPunct($query);	// call the function removeStopPunction to remove stopwords and punctuation from query

	formatQueries($query, $blekkoQuery, $bingQuery);	// function to format all the queries, see functions.php

	//basic details for google
	$googleUri = 'https://www.googleapis.com/customsearch/v1';
	$googleKey = 'AIzaSyBC7LTwjigjtm0VCefZJYKnoV6Zgxv0Mp0';
	$googleSearchEngine = '004504004301264760648:jsadim8nlyi';
	$googleUrl_1 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=1&q=$query&alt=json";
	$googleUrl_2 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=10&q=$query&alt=json";
	$googleUrl_3 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=20&q=$query&alt=json";
	$googleUrl_4 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=30&q=$query&alt=json";
	$googleUrl_5 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=40&q=$query&alt=json";
	$googleUrl_6 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=50&q=$query&alt=json";
	$googleUrl_7 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=60&q=$query&alt=json";
	$googleUrl_8 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=70&q=$query&alt=json";
	$googleUrl_9 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=80&q=$query&alt=json";
	$googleUrl_10 = "$googleUri?key=$googleKey&cx=$googleSearchEngine&num=10&start=90&q=$query&alt=json";


	//basic details for blekko
	$blekkoUri = 'http://blekko.com/ws/';
	$blekkoKey = 'f4c8acf3';
	$blekkoUrl = "$blekkoUri?q=$blekkoQuery+/json+/ps=100&auth=$blekkoKey&p=0";

	//basic details for bing
	$bingKey = '7dj0xTTJ/Ncs4MY66xuBuMf0XDtfY6va+rnolQh13Jo';
	$bingUri = 'https://api.datamarket.azure.com/Bing/Search';
	$bingUrl_1 = "$bingUri/Web?\$format=json&\$top=100&Query=$bingQuery";
	$bingUrl_2 = "$bingUri/Web?\$format=json&\$top=100&\$skip=50&Query=$bingQuery"; 
 

	//initiate cURL handles for the three sites
	$chGoogle_1 = curl_init();		// google will only return 10 each time so needs 10 handles to return 100 results
	$chGoogle_2 = curl_init();
	$chGoogle_3 = curl_init();
	$chGoogle_4 = curl_init();
	$chGoogle_5 = curl_init();
	$chGoogle_6 = curl_init();
	$chGoogle_7 = curl_init();
	$chGoogle_8 = curl_init();
	$chGoogle_9 = curl_init();
	$chGoogle_10 = curl_init();		
	$chBlekko = curl_init();
	$chBing_1 = curl_init();
	$chBing_2 = curl_init();

	// set the google curl options, i.e. the url, returntype as a string, verify certificate off
	curl_setopt($chGoogle_1,CURLOPT_URL,$googleUrl_1);
	curl_setopt($chGoogle_1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_2,CURLOPT_URL,$googleUrl_2);
	curl_setopt($chGoogle_2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_2, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_3,CURLOPT_URL,$googleUrl_3);
	curl_setopt($chGoogle_3, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_3, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_4,CURLOPT_URL,$googleUrl_4);
	curl_setopt($chGoogle_4, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_4, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_5,CURLOPT_URL,$googleUrl_5);
	curl_setopt($chGoogle_5, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_5, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_6,CURLOPT_URL,$googleUrl_6);
	curl_setopt($chGoogle_6, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_6, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_7,CURLOPT_URL,$googleUrl_7);
	curl_setopt($chGoogle_7, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_7, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_8,CURLOPT_URL,$googleUrl_8);
	curl_setopt($chGoogle_8, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_8, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_9,CURLOPT_URL,$googleUrl_9);
	curl_setopt($chGoogle_9, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_9, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chGoogle_10,CURLOPT_URL,$googleUrl_10);
	curl_setopt($chGoogle_10, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chGoogle_10, CURLOPT_SSL_VERIFYPEER, false);
	// set the blekko curl options, same as google
	curl_setopt($chBlekko,CURLOPT_URL,$blekkoUrl);
	curl_setopt($chBlekko, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chBlekko, CURLOPT_SSL_VERIFYPEER, false);
	// set the bing curl options, extra option userpwd sets the password as the bing key
	curl_setopt($chBing_1,CURLOPT_URL,$bingUrl_1);
	curl_setopt($chBing_1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chBing_1, CURLOPT_USERPWD, $bingKey.':'.$bingKey);
	curl_setopt($chBing_1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chBing_2,CURLOPT_URL,$bingUrl_2);
	curl_setopt($chBing_2, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($chBing_2, CURLOPT_USERPWD, $bingKey.':'.$bingKey);
	curl_setopt($chBing_2, CURLOPT_RETURNTRANSFER, true);

	//create the multiple cURL handle
	$mh = curl_multi_init();

	//add the handles to the multi handle
	curl_multi_add_handle($mh,$chGoogle_1);
	curl_multi_add_handle($mh,$chGoogle_2);
	curl_multi_add_handle($mh,$chGoogle_3);
	curl_multi_add_handle($mh,$chGoogle_4);
	curl_multi_add_handle($mh,$chGoogle_5);
	curl_multi_add_handle($mh,$chGoogle_6);
	curl_multi_add_handle($mh,$chGoogle_7);
	curl_multi_add_handle($mh,$chGoogle_8);
	curl_multi_add_handle($mh,$chGoogle_9);
	curl_multi_add_handle($mh,$chGoogle_10);
	curl_multi_add_handle($mh,$chBlekko);
	curl_multi_add_handle($mh,$chBing_1);
	curl_multi_add_handle($mh,$chBing_2);

	$active = null;
	//execute the handles
	do {
    	$mrc = curl_multi_exec($mh, $active);
	} while ($active >0);


	//get results from handles
	$jsonGoogle_1 = curl_multi_getcontent($chGoogle_1);
	$jsonGoogle_2 = curl_multi_getcontent($chGoogle_2);
	$jsonGoogle_3 = curl_multi_getcontent($chGoogle_3);
	$jsonGoogle_4 = curl_multi_getcontent($chGoogle_4);
	$jsonGoogle_5 = curl_multi_getcontent($chGoogle_5);
	$jsonGoogle_6 = curl_multi_getcontent($chGoogle_6);
	$jsonGoogle_7 = curl_multi_getcontent($chGoogle_7);
	$jsonGoogle_8 = curl_multi_getcontent($chGoogle_8);
	$jsonGoogle_9 = curl_multi_getcontent($chGoogle_9);
	$jsonGoogle_10 = curl_multi_getcontent($chGoogle_10);
	$jsonBlekko = curl_multi_getcontent($chBlekko);
	$jsonBing_1 = curl_multi_getcontent($chBing_1);
	$jsonBing_2 = curl_multi_getcontent($chBing_2);

	//decode the json strings into arrays
	$resultsGoogle = array();
	$resultsGoogle[0] = json_decode($jsonGoogle_1);
	$resultsGoogle[1] = json_decode($jsonGoogle_2);
	$resultsGoogle[2] = json_decode($jsonGoogle_3);
	$resultsGoogle[3] = json_decode($jsonGoogle_4);
	$resultsGoogle[4] = json_decode($jsonGoogle_5);
	$resultsGoogle[5] = json_decode($jsonGoogle_6);
	$resultsGoogle[6] = json_decode($jsonGoogle_7);
	$resultsGoogle[7] = json_decode($jsonGoogle_8);
	$resultsGoogle[8] = json_decode($jsonGoogle_9);
	$resultsGoogle[9] = json_decode($jsonGoogle_10);
	$resultsBlekko = json_decode($jsonBlekko);
	$resultsBing = array();
	$resultsBing[0] = json_decode($jsonBing_1);
	$resultsBing[1] = json_decode($jsonBing_2);

	//close the handles
	curl_multi_remove_handle($mh, $chGoogle_1);
	curl_multi_remove_handle($mh, $chGoogle_2);
	curl_multi_remove_handle($mh, $chGoogle_3);
	curl_multi_remove_handle($mh, $chGoogle_4);
	curl_multi_remove_handle($mh, $chGoogle_5);
	curl_multi_remove_handle($mh, $chGoogle_6);
	curl_multi_remove_handle($mh, $chGoogle_7);
	curl_multi_remove_handle($mh, $chGoogle_8);
	curl_multi_remove_handle($mh, $chGoogle_9);
	curl_multi_remove_handle($mh, $chGoogle_10);
	curl_multi_remove_handle($mh, $chBlekko);
	curl_multi_remove_handle($mh, $chBing_1);
	curl_multi_remove_handle($mh, $chBing_2);
	curl_multi_close($mh);

	$blingoArray = array();    // will hold all the unique results along with their RRF scores

	// Loop through all 3 results sets, putting Title,Url and snippet for each in a 3 dimentional array.
	// In the same loop create a results string for each search engine.
	$googleArray = array();
	$googleResultsStr = array();
	$i = 0; // increments every loop, used to store the google values in the propper place in one big array	
  if(property_exists($resultsGoogle[0], 'items'))	// check to see that the api has returned expected object
  {	
	foreach($resultsGoogle as $results)
	{
		foreach($results->items as $value) 
		{  
			$j = (int) $i / 10;				// $j will increment every 10 loops, used for pagination of the results strings
			if (($i == 0)||($i % 10 == 0))	// i.e. every 10 loops
				$googleResultsStr[$j] = "<h1>Google Results for for \"{$_POST['query']}\"</h1> <br />";	//initialise to the empty string for concatonation to work
			$googleRank = $i + 1;			// store the rank of the result
			$googleResultsStr[$j] .= "<a href=\"{$value->link}\"><h2>$googleRank. {$value->title}</h2></a><h3>{$value->link}</h3><p>{$value->snippet}</p>";
    		$googleArray[$i][0] = "{$value->link}";
    		$googleArray[$i][1] = "{$value->title}";
    		$googleArray[$i][2] = "{$value->snippet}";
    		$googleArray[$i][3] = $googleWeighting / (60 + $i + 1); //formula for finding the reciprocal rank value    
			$googleArray[$i][4] = standardiseUrls($googleArray[$i][0]); // standardise the url so they can be compared
			$blingoArray[] = $googleArray[$i];	// add page details to the end of the blingo array, no need to check for matches
    		$i++;
		}
	}
  }
	$blekkoArray = array();
	$blekkoResultsStr = array();
	$i = 0;
  if(property_exists($resultsBlekko, 'RESULT'))		// check to see that the api has returned expected object
  {	
	foreach($resultsBlekko->RESULT as $value)
	{
		$blekkoRank = $i + 1;					// store the rank of the document
		if (property_exists($value,'snippet'))//some results from blekko do not return snippets
		{
			$j = (int) $i / 10;				// $j will increment every 10 loops, used for pagination of the results strings
			$snippet = strip_tags("{$value->snippet}");	// strip <strong> tags from the blekko string
			
			if (($i == 0)||($i % 10 == 0))							// i.e. every 10 loops
				$blekkoResultsStr[$j] = "<h1>Blekko Results for \"{$_POST['query']}\"</h1> <br />";	// initialise new result string to the empty string

			$blekkoResultsStr[$j] .= "<a href=\"{$value->url}\"><h2>$blekkoRank. {$value->url_title}</h2></a><h3>{$value->url}</h3><p>$snippet</p>";
			$blekkoArray[$i][0] = "{$value->url}";
    		$blekkoArray[$i][1] = "{$value->url_title}";
    		$blekkoArray[$i][2] = $snippet; // remove html as blekko snippet has queried words in <strong>
    		$blekkoArray[$i][3] = $blekkoWeighting / (60 + $i + 1); 	//formula for finding the reciprocal rank value
    		$blekkoArray[$i][4] = standardiseUrls($blekkoArray[$i][0]); // standartise the url so they can be compared
			addResult($blekkoArray[$i], $blingoArray);	// function to check if the page is already in blingoArray
	  													// if so just ammend the rrf score, if not add it to the end
      		$i++;
		}
		
		else
		{
    		$j = (int) $i / 10;				// $j will increment every 10 loops, used for pagination of the results strings
			if (($i == 0)||($i % 10 == 0))							// i.e. every 10 loops
				$blekkoResultsStr[$j] = "<h1>Blekko Results for \"{$_POST['query']}\"</h1> <br />";	// initialise new result string to the empty string

			$blekkoResultsStr[$j] .= "<a href=\"{$value->url}\"><h2>$blekkoRank. {$value->url_title}</h2></a><h3>{$value->url}</h3><p>No description supplied by Blekko</p>";
			$blekkoArray[$i][0] = "{$value->url}";
			$blekkoArray[$i][1] = "{$value->url_title}";
			$blekkoArray[$i][2] = "No description supplied by Blekko";
			$blekkoArray[$i][3] = $blekkoWeighting / (60 + $i + 1); 	//formula for finding the reciprocal rank value
			$blekkoArray[$i][4] = standardiseUrls($blekkoArray[$i][0]); // standartise the url so they can be compared
			addResult($blekkoArray[$i], $blingoArray);
			$i++;
		}
	}
  }
	$bingArray = array();
	$bingResultsStr = array();
	$i = 0;
  if(property_exists($resultsBing[0],'d'))	// check to see that the api has returned expected object
  {	
	foreach($resultsBing as $results)
	{
		foreach($results->d->results as $value)
		{
			$bingRank = $i + 1;				// store the document rank
    		$j = (int) $i / 10;				// $j will increment every 10 loops, used for pagination of the results strings
			if (($i == 0)||($i % 10 == 0))	// i.e. every 10 loops
	  			$bingResultsStr[$j] = "<h1>Bing Results for \"{$_POST['query']}\"</h1> <br />";	// initialise new result string to the empty string
	  
    		$bingResultsStr[$j] .= "<a href=\"{$value->Url}\"><h2>$bingRank. {$value->Title}</h2></a><h3>{$value->Url}</h3><p>{$value->Description}</p>";
    		$bingArray[$i][0] = "{$value->Url}";
    		$bingArray[$i][1] = "{$value->Title}";
    		$bingArray[$i][2] = "{$value->Description}";
    		$bingArray[$i][3] = $bingWeighting / (60 + $i + 1); 	//formula for finding the reciprocal rank value
    		$bingArray[$i][4] = standardiseUrls($bingArray[$i][0]); // standartise the url so they can be compared
			addResult($bingArray[$i], $blingoArray);
			$i++;
		}
	}
  }
  
	usort($blingoArray,"cmp");		// function to sort the blingo results array by tfidf score in decending order
	if (sizeof($blingoArray) > 100)
		$blingoArray =  array_slice($blingoArray, 0, 100);   	// trim the sorted array down to 100 
	
	$k = 5;													// k is the number of clusters in the kmeans algorithm
	$numIterations = 25;										// number of times to run the kmeans algorithm
	if ($_POST['clustering'] == "on")						// if the user chose clustering to be on
	{														// Call the clusterResults function to cluster the results passing
		clusterResults($blingoArray, $k, $numIterations);	// results array in by reference, $k, and $numIterations
		$clusterResultsStr = array();						// initialise the array to hold the results strings for the clusters
	}
	$blingoResultsStr = array();
	$clusterResultsStr = array();
	$clusterCorpus = array();
	$i=0;
	foreach($blingoArray as $index => $result)
	{
		$blingoRank = $index + 1;		// store the rank of the result
		$j = (int) $i / 10;				// $j will increment every 10 loops, used for pagination of the results strings
		if (($i == 0)||($i % 10 == 0))	// if its the first time the element in the array is being populated, i.e. every 10 loops	
			$blingoResultsStr[$j] = "<h1>Blingo Results for \"{$_POST['query']}\"</h1> <br />";// must be initialised as empty string for .= to work(next line)
   	
		$blingoResultsStr[$j] .= "<a href=\"{$result[0]}\"><h2>$blingoRank. {$result[1]}</h2></a><h3>{$result[0]}</h3><p>{$result[2]}</p>";		
	
		if($_POST['clustering'] == "on")			// if clustering is on, populate the individual cluster results strings
		{
			if (!isset($clusterResultsStr[$result[7]])) // if its first instance of the key
			{
				$clusterResultsStr[$result[7]] = '';	//initialise the results string so .= will work
				$clusterCorpus[$result[7]] = '';		//initialise the cluster corpus too(needed to get meaningful name)
			}
			$clusterResultsStr[$result[7]] .= "<a href=\"{$result[0]}\"><h2>{$result[1]}</h2></a><h3>{$result[0]}</h3><p>{$result[2]}</p>";
			$clusterCorpus[$result[7]] .= "{$result[2]}";	// corpus consists of the snippets concatonated
			
		}
		$i++;						// increment $i, which will encrement $j every 10th loop thus paginating
	}
	
	if($_POST['clustering'] == "on")
	{										// if Clustering is turned on
		$clusterNames = getClusterNames($clusterCorpus, strtolower($_POST['query']));	// get meaningful names for the clusters
		foreach($clusterResultsStr as $index=>$output)
		{
			$clusterResultsStr[$index] = "<h1>Category: {$clusterNames[$index]}</h1> <br />" . $output;
		}
	}
}
?>