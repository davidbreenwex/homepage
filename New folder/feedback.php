<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blingo Metasearch Engine Feedback</title>
<link href="blingostyle.css" rel="stylesheet" type="text/css" />
<script src="jsFunctions.js"></script>								<!-- link the javascript functions file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> <!-- link jquery -->
</head>

<body>
<div id="wrapper"> 
  <div id="navigation">
    <ul id="menu-bar">
    <li><a href="blingo.html">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li class="active"><a href="#">Feedback</a></li>
    </ul>
  </div>
  <div id="outerlogo">
    <div id="logo"><img src="images/logo.png" width="400" height="104" alt="Blingo Logo" /></div>
  </div>
  <div id="body">
  <h2 id="greyheading">Feedback Form</h2>
 <div id="feedbackform" align="center">
	<form id="contactform" method="POST" action="processform.php">
      <label for="name">Enter Your Name: </label>
      <input name="name" type="text" size="30" value="Optional"/><br /><br />
 	  <label for="1">1. What is currently your default search engine?</label>
      <input name="1" type="text" size="30" /><br  />
      <h3>Rate the following features of Blingo Metasearch Engine from 1 - 10 (1=bad 10=good)</h3>
      <label for="2">2. Quality of Results from Blingo versus your normal search engine: </label><br />
      <input name="2" type="radio" value="1" /> 1
      <input name="2" type="radio" value="2" /> 2
      <input name="2" type="radio" value="3" /> 3
      <input name="2" type="radio" value="4" /> 4
      <input name="2" type="radio" value="5" checked /> 5
      <input name="2" type="radio" value="6" /> 6
      <input name="2" type="radio" value="7" /> 7
      <input name="2" type="radio" value="8" /> 8
      <input name="2" type="radio" value="9" /> 9
      <input name="2" type="radio" value="10" /> 10 <br /><br />
      <label for="3">3. User friendliness of the site: </label><br />
      <input name="3" type="radio" value="1" /> 1
      <input name="3" type="radio" value="2" /> 2
      <input name="3" type="radio" value="3" /> 3
      <input name="3" type="radio" value="4" /> 4
      <input name="3" type="radio" value="5" checked /> 5
      <input name="3" type="radio" value="6" /> 6
      <input name="3" type="radio" value="7" /> 7
      <input name="3" type="radio" value="8" /> 8
      <input name="3" type="radio" value="9" /> 9
      <input name="3" type="radio" value="10" /> 10 <br /><br  />
      <label for="4">4. The clustering functionality of the site: </label><br />
      <input name="4" type="radio" value="1" /> 1
      <input name="4" type="radio" value="2" /> 2
      <input name="4" type="radio" value="3" /> 3
      <input name="4" type="radio" value="4" /> 4
      <input name="4" type="radio" value="5" checked /> 5
      <input name="4" type="radio" value="6" /> 6
      <input name="4" type="radio" value="7" /> 7
      <input name="4" type="radio" value="8" /> 8
      <input name="4" type="radio" value="9" /> 9
      <input name="4" type="radio" value="10" /> 10 <br /><br  />
      <label for="5">5. The query rewriting functionality of the site: </label><br />
      <input name="5" type="radio" value="1" /> 1
      <input name="5" type="radio" value="2" /> 2
      <input name="5" type="radio" value="3" /> 3
      <input name="5" type="radio" value="4" /> 4
      <input name="5" type="radio" value="5" checked /> 5
      <input name="5" type="radio" value="6" /> 6
      <input name="5" type="radio" value="7" /> 7
      <input name="5" type="radio" value="8" /> 8
      <input name="5" type="radio" value="9" /> 9
      <input name="5" type="radio" value="10" /> 10 <br /><br  />
      <label for="6">6. The style/presentation of the site: </label><br />
      <input name="6" type="radio" value="1" /> 1
      <input name="6" type="radio" value="2" /> 2
      <input name="6" type="radio" value="3" /> 3
      <input name="6" type="radio" value="4" /> 4
      <input name="6" type="radio" value="5" checked /> 5
      <input name="6" type="radio" value="6" /> 6
      <input name="6" type="radio" value="7" /> 7
      <input name="6" type="radio" value="8" /> 8
      <input name="6" type="radio" value="9" /> 9
      <input name="6" type="radio" value="10" /> 10 <br /><br  />
      <label for="7">7. The speed of the search engine: </label><br />
      <input name="7" type="radio" value="1" /> 1
      <input name="7" type="radio" value="2" /> 2
      <input name="7" type="radio" value="3" /> 3
      <input name="7" type="radio" value="4" /> 4
      <input name="7" type="radio" value="5" checked /> 5
      <input name="7" type="radio" value="6" /> 6
      <input name="7" type="radio" value="7" /> 7
      <input name="7" type="radio" value="8" /> 8
      <input name="7" type="radio" value="9" /> 9
      <input name="7" type="radio" value="10" /> 10 <br /><br  />
	  <label for="8">8. Queries are throttled to 1 query every 10 seconds. Did this negatively affect your experience? </label>
      <input name="8" type="radio" value="Yes" />Yes
      <input name="8" type="radio" value="No" checked />No <br /><br  />
	  <label for="9">9. Would you now use blingo as your default search engine? </label>
      <input name="9" type="radio" value="Yes" checked />Yes
      <input name="9" type="radio" value="No" />No <br /><br  />
      <label for="comment">10. Additional Comments</label><br />
      <textarea name="comment" cols="75" rows="12">Enter constructive criticism here!!</textarea><br />
      <input type="submit" name="submit" value="Submit" />
	</form>
  </div>
</div>
</body>
</html>