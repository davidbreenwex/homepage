<?php
//Function to check if a url is already in the blingo array
//Takes the details of the page to be tested
function addResult($testPageDetails, &$blingoArray)
{
    $top = sizeof($blingoArray) - 1;
    $bottom = 0;

	while($bottom <= $top)	// loop through blingo array and test for the same url
    {
        if($blingoArray[$bottom][4] == $testPageDetails[4])			//If the url has been returned by other search engine too
            {
			$blingoArray[$bottom][3] += $testPageDetails[3];		//Add the RRF score to the blingoArray
			return 0;												//exit the function
		    }
        else{ 										//The url hasn't been returned by other search engine
            $bottom++;								//Increment to the next result in blingoArray
            }
    }
	$blingoArray[] = $testPageDetails;	//Add the test page details to the end of blingo array
    return 0;							//exit the function
}

//*****************************************************************************************************************//
//Function to format the query to suit the 3 search engines.
//Takes the $query (used by google and bing) snd $blekko as parameters by reference
function formatQueries(&$query, &$blekkoQuery, &$bingQuery)
{
	$query = str_replace(" AND ","+",$query);	//remove AND as it is implied in all three search engines
	$query = str_replace(" NOT "," -",$query);	//remove NOT and replace it with - with no space between it and next word
	$query = str_replace(" - ", " -",$query);	//remove the space between - and the following word
	$blekkoQuery = str_replace(" OR "," ",$query);//remove OR from the blekko query as blekko doesn't support it
	$query = str_replace(" OR ","+||+",$query);	//replace OR with +||+ in the normal query
	$query = strtolower(str_replace(" ","+",$query));	// lovercase the queries
	$blekkoQuery = strtolower(str_replace(" ","+",$blekkoQuery)); // change the spaces to +
	$bingQuery = "'".$query."'"; 				// single quotes must surround the query in bing
	// maybe remove punctuation here too
}
//*****************************************************************************************************************//
// Function to manupulate the urls returned by the three search engines into a uniform format so they can be compared
// Takes the url/link as a string parameter and returns the formatted string
function standardiseUrls($url)
{
	$parsedUrl = parse_url($url);// parse the url into an array containging 'host','path' and other variables
	if (substr($parsedUrl['host'],0,4) == 'www.'){	// if the host has www on the front
		$parsedUrl['host'] = substr($parsedUrl['host'],4);	// delete it
		}
	return $parsedUrl['host']."/".$parsedUrl['path'];	//return the standardises array. i.e. the host portion -www + path
}

//*****************************************************************************************************************//
//***************** Function to remove stopwords and punctuation, i.e. query preprocessing ************************//
function removeStopPunct($query)
{
	$stopwords = array(" a ", " about ", " above ", " above ", " across ", " after ", " afterwards ", " again ", " against ", " all ", " almost ", " alone ", " along ", " already ", " also "," although "," always "," am "," among ", " amongst ", " amoungst ", " amount ", " an ", " and ", " another ", " any "," anyhow "," anyone "," anything "," anyway ", " anywhere ", " are ", " around ", " as ", " at ", " back "," be "," became ", " because "," become "," becomes ", " becoming ", " been ", " before ", " beforehand ", " behind ", " being ", " below ", " beside ", " besides ", " between ", " beyond ", " bill ", " both ", " bottom "," but ", " by ", " call ", " can ", " cannot ", " cant ", " co ", " con ", " could ", " couldnt ", " cry ", " de ", " describe ", " detail ", " do ", " done ", " down ", " due ", " during ", " each ", " eg ", " eight ", " either ", " eleven "," else ", " elsewhere ", " empty ", " enough ", " etc ", " even ", " ever ", " every ", " everyone ", " everything ", " everywhere ", " except ", " few ", " fifteen ", " fify ", " fill ", " find ", " fire ", " first ", " five ", " for ", " former ", " formerly ", " forty ", " found ", " four ", " from ", " front ", " full ", " further ", " get ", " give ", " go ", " had ", " has ", " hasnt ", " have ", " he ", " hence ", " her ", " here ", " hereafter ", " hereby ", " herein ", " hereupon ", " hers ", " herself ", " him ", " himself ", " his ", " how ", " however ", " hundred ", " ie ", " if ", " in ", " inc ", " indeed ", " interest ", " into ", " is ", " it ", " its ", " itself ", " keep ", " last ", " latter ", " latterly ", " least ", " less ", " ltd ", " made ", " many ", " may ", " me ", " meanwhile ", " might ", " mill ", " mine ", " more ", " moreover ", " most ", " mostly ", " move ", " much ", " must ", " my ", " myself ", " name ", " namely ", " neither ", " never ", " nevertheless ", " next ", " nine ", " no ", " nobody ", " none ", " noone ", " nor ", " not ", " nothing ", " now ", " nowhere ", " of ", " off ", " often ", " on ", " once ", " one ", " only ", " onto ", " or ", " other ", " others ", " otherwise ", " our ", " ours ", " ourselves ", " out ", " over ", " own "," part ", " per ", " perhaps ", " please ", " put ", " rather ", " re ", " same ", " see ", " seem ", " seemed ", " seeming ", " seems ", " serious ", " several ", " she ", " should ", " show ", " side ", " since ", " sincere ", " six ", " sixty ", " so ", " some ", " somehow ", " someone ", " something ", " sometime ", " sometimes ", " somewhere ", " still ", " such ", " system ", " take ", " ten ", " than ", " that ", " the ", " their ", " them ", " themselves ", " then ", " thence ", " there ", " thereafter ", " thereby ", " therefore ", " therein ", " thereupon ", " these ", " they ", " thick ", " thin ", " third ", " this ", " those ", " though ", " three ", " through ", " throughout ", " thru ", " thus ", " to ", " together ", " too ", " top ", " toward ", " towards ", " twelve ", " twenty ", " two ", " un ", " under ", " until ", " up ", " upon ", " us ", " very ", " via ", " was ", " we ", " well ", " were ", " what ", " whatever ", " when ", " whence ", " whenever ", " where ", " whereafter ", " whereas ", " whereby ", " wherein ", " whereupon ", " wherever ", " whether ", " which ", " while ", " whither ", " who ", " whoever ", " whole ", " whom ", " whose ", " why ", " will ", " with ", " within ", " without ", " would ", " yet ", " you ", " your ", " yours ", " yourself ", " yourselves ", " the "); // list of stopwords with spaces on both sides
	
	$punctuation = array("+",",",".","-","'","\"","&","!","?",":",";","#","~","=","/","$","£","^","(",")","_","<",">");
	$query = " ".$query." ";	//add space before the first word and after the last word- words stored as " word " with spaces
	$query = str_replace($punctuation,"",$query);	//remove selected punctuation marks from the query
	$query = str_ireplace($stopwords," ",$query);	//case insensitive function to remove any stopwords from the query
	$query = substr($query,1,-1);	// remove the spaces added earlier
	return $query;
}

// function to compare the tfidf scores in the aggregated results in blingoArray. Used in the usort function to sort by tfidf
function cmp($a, $b)
{
        return $a[3] < $b[3];		// return the comparison of tfidf scores
}
//******************************************************************************************************************//
//*********************************************CLUSTERING FUNCTIONS*************************************************//

// Function to get the inverse document frequency for the clustering categories
// Takes the word from the corpus and the results set as parameters and returns the inverse document frequency for the word
function inverseDocumentFrequency($word, &$results)
{
	$totalDocuments = sizeof($results); 		// number of documents in the results, needed for idf calculation
	$frequency = 0;								// how many documents contain the word
	foreach ($results as $details)				// iterate through the results
	{
		$snippet = strtolower($details[2]);		// lowercase the snippet
		if (strpos($snippet, $word) !== false)	// if the current snippet contains the word
			$frequency++;						// increment the frequency counter
	}
	if ($frequency != 0)						// if the word has been matched at least once
		return log10($totalDocuments/$frequency);	// idf=log10(N/df)
	else										// if the word hasn't been matched, happens for malformed words
		return 0.0;
}

// Function to return the vocabulary, i.e. an array of all the words used in the corpus - stopwords
// Returns a multidimentional array containing all the words along with their frequency in the corpus and their idf
function getCorpusWords(&$results)
{
	$corpusWordFrequency = array();		//will hold an associative array of all the words in the corpus and their frequency
	$corpusWords = array();				//multidimentional array holding the word,frequency and idf for each word
	$corpus = '';						//variable to hold all the snippets concatonated
	foreach ($results as $details)		//iterate through the results array
	{
		$snippet = removeStopPunct($details[2]);	// remove the punctuation and stopwords
		$corpus .= $snippet . " ";					// add the snippet to the corpus plus a space
	}
	$corpus = strtolower($corpus);					// lowercase the corpus to compare words accurately
	$corpusWordFrequency = array_count_values(str_word_count($corpus, 1));	//2 functions which return an array with
	arsort($corpusWordFrequency);		//Sort the array by frequency		//the frequency of each word in the string

	$i=0;
	foreach ($corpusWordFrequency as $key=>$value)	//iterate through the array starting with most frequent word
	{
			$corpusWords[$i][0] = $key;										//store the word
			$corpusWords[$i][1] = $value;									//store the frequency
			$corpusWords[$i][2] = inverseDocumentFrequency($key, $results);	//store the idf
			$i++;															//increment to the next word 
	}
	return $corpusWords;
}


//Function to create the multidimentional array to store the documents tf-idf co-ordinates for each of the cluster terms
function getVectorCoordinates(&$results, $corpusWords)
{	
	$maxFrequency = $corpusWords[0][1];	// Stores the frequency of the most frequent word in the corpus
	$i = 0; 							// counter for the results
	foreach ($results as $details)		// for  all the results in blingoArray
	{
		$results[$i][5] = 0;		// will be used to store the length of each vector, used in normalising vectors
		$sumOfSquares = 0;			// used to calculate length of each vector
		$j=0;						// counter for where to store the tfidf score for each term.
									// start at 6 because the first 5 fields are filled with link,snippet,title,rrf,url and length
		foreach ($corpusWords as $corpusWord)	// iterate through all the words in the corpus
		{
			$frequency = 0;									// counts the occourances of the word in the snippet
			$snippet = strtolower($details[2]);				// lowercase the snippet for comparison
			$snippetWords = str_word_count($snippet, 1);	// array of the words in the snippet
			foreach ($snippetWords as $word)				// count occourances of the word in the snippet
			{
				if ($word == $corpusWord[0])				// if the word is in the snippet
					$frequency++;							// increment if found
			}
			$results[$i][6][$j] = ($frequency/$maxFrequency)*$corpusWord[2];//stores tf-idf score for term in the results array
			$sumOfSquares += ($results[$i][6][$j])*($results[$i][6][$j]);	// add the square of the tf-idf to sumOfSquares
			$j++;											// increment to the next field to store tfidf score for next word
		}
		$results[$i][5] = sqrt($sumOfSquares);				// length of vector = square root of the sum of squares of its
		$i++;												// increment to the next document in the results
	}
}

//Function to set the initial seed centroid for k clusters
function initialiseCentroids($k, &$results)
{
	$clusterCentroids = array();
	$numResults = sizeof($results) - 1;	// get the size of the array(minus 1 for the index)
	$random = range(0,$numResults);		// array of unique random numbers between 0 and k-1
	shuffle($random);					// randomise the elements in the array using shuffle function
	
	for($i=0; $i<$k; $i++)				// loop to populate the array $clusterCentroids with k document vectors
	{
		$clusterCentroids[$i][0] = $results[$random[$i]][6]; // populate with the vector of a random document in results set
		$clusterCentroids[$i][1] = $results[$random[$i]][5]; // populate with the length of the vecotor array
		$clusterCentroids[$i][2] = array();					 // will hold a list of the vectors within the cluster
	}
	return $clusterCentroids;			// return the array of k random document vectors
}

// Function to get the cosine similarity of two vectors given 
function getCosSim($v1,$m1,$v2,$m2)
{
	$numDimensions = sizeof($v1);			// number of dimensions in the vectors
	$dotProduct = 0.0;						// variable to hold the dot product of the vectors
	for($i=0; $i<$numDimensions; $i++)		// iterate through both vector's dimensions
	{
		$dotProduct += ($v1[$i] * $v2[$i]); // add the product of the corrisponding dimensions of each vector
	}
	if ($m1 != 0 && $m2 != 0){				// some documents returned from blekko will not have snippets so magnitude is 0
		$cosSim = $dotProduct/($m1 * $m2);	// formula for cosine simularity dotproduct/product of lengths
		return $cosSim;
		}
	else 
		return 0;							// if either is 0 return cosSim as 0. required because division by 0 is not allowed
}

// Function to assign each document in the results set to its nearest cluster
function assignResults(&$results, &$clusterCentroids)
{
	$i=0;												// counter for the results documents index
	foreach($results as $details)
	{
		$clusterNumber = 0;								// declare the variable, doesn't matter what the value is.
		$maxCos = 0;									// will hold the max cosine similarity of a document/cluster
		$index = 0;
		foreach($clusterCentroids as $key=>$centroid)	// iterate through the cluster centroids
		{
			$cosSim = getCosSim($details[6],$details[5],$centroid[0],$centroid[1]);
			if ($cosSim >= $maxCos)						// if the document vector is nearer than any previous clusters
			{
				$index = $key;
				$results[$i][7] = $index;	// assign the document to that cluster using its index in the clusterCentroids array
				$maxCos = $cosSim;			// increase the maxCos to the current cosine simiarity
			}
		}
		$clusterCentroids[$index][2][] = $details[6];	// add the document vector to the corrisponding clusterCentroids Array
		$i++;												//increment the results counter
	}
}

// Function to recalculate the centroid of each cluster
function reviseCentroids(&$clusterCentroids)
{
	$noChange = 0;											// variable to check if the centroid vectors havn't changed.
	$oldClusterCentroids= $clusterCentroids;
	foreach($clusterCentroids as $cluster)					// increment through each cluster (0 to k-1)
	{
		$newCentroid = array();								// will store the coordinates of the new centroid vector
		for($i=0; $i<sizeof($clusterCentroids[0][0]); $i++)	// loop through all the dimensions of the vector
		{
			$newCentroid[$i] = 0;							// initialise each dimension to 0 so the += operator can be used
		}
		$sumOfSquares = 0;									// initialise sum the sum of squares to 0 so += operator can be used

		foreach ($cluster[2] as $vector)			// for each vector assigned to the cluster
		{
			$i=0;									// counter for the index of the current coordinate
			foreach($vector as $coordinate)			// for each coordinate of the vector
			{
				$newCentroid[$i] += $coordinate;	// sum the corrisponding coordinates, will divide by ammount of docs later
				$sumOfSquares += ($coordinate);		// used for calculating the magnitude/length of the vector
				$i++;								// increment to the next coordinate
			}
		}
		foreach($newCentroid as $coordinate)		// for each coordinate in the new centroid
		{
			$coordinate = ($coordinate / sizeof($cluster[2]));	// get the average for each coordinate	
		}
		if ($cluster[0]==$newCentroid)					// if the old vector and the new one are the same
			$noChange++;							// increment the $noChange Variable
		$cluster[0] = $newCentroid;					// assign the new centroid to the cluster
		$cluster[1] = sqrt($sumOfSquares);			// assign the new magnetude/length to the centroid
	}
	return $noChange;								// return the count of exactly the same vectors if 5 stop the algorithm
}
// Function to empty each of the clusterCentroids of their stored vectors so they can be repopulated
function emptyClusterVectors(&$clusterCentroids, $k)
{
	for($i=0; $i<$k; $i++)							// loop through all the clusterCentroid Arrays, k arrays
	{
		$clusterCentroids[$i][2] = array();			// empty clusters of vectors ([2]) so they can be reassigned from scratch	
	}
}

//****************** Function to take blingo results and cluster into 5 clusters using k-means method **************//
function clusterResults(&$results, $k, $numIterations)
{
	$test = 0;											// test how many centroids have stayed the same
	$corpusWords = getCorpusWords($results);			// returns multidimensional array of: the words in the corpus, their 
														// frequency and their inverse document frequency
	getVectorCoordinates($results, $corpusWords);		// add the document vector coordinates and vector length
														// to the results array, i.e. blingoArray
	$clusterCentroids = initialiseCentroids($k,$results);	// randomly assign document vectors as the cluster seeds
	
	for($i=0; $i<$numIterations && $test!=5; $i++)		// run the k-means algrithm the specified number of times
	{													// or until the centroids don't change
		assignResults($results, $clusterCentroids);		// assign each document in results set to its nearest vector
		$test = reviseCentroids($clusterCentroids);				// calculate and store the revised centroid vector
		emptyClusterVectors($clusterCentroids, $k);		// empty clusters of vectors so they can be reassigned from scratch
	}
	
}

//Function to get the most frequent non stop words, non query words in each cluster corpus and assign it that name
//Takes the array of cluster corpus's and the unprocessed query as parameters and returns an array of category names.
function getClusterNames(&$clusterCorpus, $query)
{
	$clusterNames = array();								// initialise the array to hold the category names
	$queryWords = str_word_count($query, 1);				// make an array of words from the query
	$newWords = array();
	$queryWords[] = "blekko";								// bug fix	
	for($i=0; $i<sizeof($queryWords); $i++)
	{
		$queryWords[$i] = $queryWords[$i] . ' ';			// add spaces after each word
	}
	foreach($queryWords as $word)							// for each query word
	{
		if ($word[strlen($word)-2] == 's')					// if they end in s
			$newWords[] = substr($word,0,-2) . ' ';			// remove it and store in $newWords
		else												// if they dont end in s
			$newWords[] = substr($word,0,-1) . 's ';		// append an s to the word
	}
	$queryWords = array_merge($queryWords, $newWords);		// merge the two arrays, now cluster names cant be $newWords either
	foreach($clusterCorpus as $key=>$corpus)				// loop throu each of the cluster's corpus's
	{
		$corpus = strtolower($corpus);						// lowercase each corpus
		$corpus = removeStopPunct($corpus);					// remove stopwords and punctuation
		$corpus = str_replace($queryWords," ",$corpus);		// remove any querywords from the corpus
		$wordCount = array_count_values(str_word_count($corpus, 1));	//return array of the words and their frequency
		arsort($wordCount);									// Sort the array by frequency
		$sortedWords = array_keys($wordCount);				// put the keys, i.e. the words in an array, [0] will be most frequent
		$i = 0;
		while((strlen($sortedWords[$i]) < 3)||(in_array($sortedWords[$i], $clusterNames)))
		{													// while the most frequent word is less than 2 chars long
			$i++;											// or the name has already been used for a cluster
		}													// move to the next most frequent wor
		$clusterNames[$key] = $sortedWords[$i];				// make the word the category name of the cluster
	}
	return $clusterNames;									// return the array of cluster names
}

?>