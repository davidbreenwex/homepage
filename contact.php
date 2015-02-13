f<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>David Breen, MSc Computer Science, Contact Page</title>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Questrial" type="text/css"/>
<meta name="description" content="David Breen MSc Computer Science Professional Website" />
<meta name="robots" content="noodp,noydir" />
<link rel="Shortcut Icon" href="Images/favicon32.ico" type="image/x-icon"> 
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<link rel="canonical" href="http://www.davidbreen.eu/" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/superfish.args.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="/davidbreen2/js/jquery.form-validator.min.js"></script>
</head>

<body class="home blog header-full-width header-image full-width-content">
<div id="wrap">
<?php include 'header.php'; ?>
<div id="home-featured"></div><!-- blue line under nav bar-->
<div id="inner">
<div class="wrap">

<div id='formDiv'>
        	<h1 align="center">Contact Form</h1>
          <form method="post" action="processForm.php" name="enquiry" id="enquiry" >
            <ol class="sideforms">
              <li> 
                <label for="name"><span id="namel">Name:</span></label>
                <input type="text" name="name" id="name" value="" data-validation="length" data-validation-length="1-30" />
              </li>
              <li> 
                <label for="email"><span id="emailFrom">Email:</span></label>
                <input type="text" name="email" id="email" value="" data-validation="email"  data-validation-optional="true" />
              </li>
              <li> 
                <label for="phone"><span id="phone">Phone:</span></label>
                <input type="text" name="phone" id="phone" data-validation="custom" data-validation-regexp="^([0-9+() ]){5,20}$" data-validation-optional="true" data-suggestions="Please enter a valid phone number or leave this section blank" />
              </li>
              <li>
                <label for="message"><span id="messagel">Message:</span></label>
                <textarea rows="10" cols="30" name="message" id="message"></textarea>
              
              </li>
              <li class="buttons-side"> 
                <input name="Submit" type="submit"  value="Click to Send">
              </li>
            </ol>
          </form>
</div>
<div id="rightContent" class="justify-center">
<p>If you have any queries please don't hesitate to contact me using this contact form or any of the following methods -<br /><br/>
Phone:&nbsp;<a id=phonelink href="tel:00353871342038">+353 87 1342038</a><br /><br />
Email:&nbsp;<a title="Contact David Breen" href="mailto:davidbreenwex@gmail.com">davidbreenwex@gmail.com</a><br /><br />
<a href="https://www.facebook.com/breeencomputerservices" target="_blank"><img src="/davidbreen2/Images/icon-facebook.png" width="37" height="36" alt=""></a><br /><br />
<a href="https://ie.linkedin.com/in/davidbreenwex/en" target="_blank"><img src="/davidbreen2/Images/icon-linkedin.png" width="37" height="36" alt=""></a><br /><br />
Mail: See address below
</p>
</div>
</div><!-- end .wrap -->
</div><!-- end #inner -->


<?php include 'footer.php'; ?>

</div><!-- end #wrap -->
<script type="text/javascript">
$( document ).ready(function() {
	addClass('menu_item_5', 'current_page_item');
});
</script>
<script> $.validate();</script>
</body>
</html>