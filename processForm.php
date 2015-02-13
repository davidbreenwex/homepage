<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Form Processer</title>
</head>

<body>
<?php
    $name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
    $subject = "Breenagri Website Feedback from: $name";
    $body = "From: $name \n\n Phone Number: $phone \n\n Email Address: $email \n\n Message: $message";
	$recipients = array(
		"davidbreenwex@gmail.com");
	$email_to = implode(',', $recipients);
    
	$sent = mail($email_to, $subject, $body);
   	if($sent){
		echo "<script>alert('Your feedback has been recieved. Thank you');</script>";
    	echo "<script>window.location = 'index';</script>";
    }	
    else{
    	echo "<script>alert('Your feedback could not be sent at this time. Please send an email to davidbreenwex@gmail.com or call +353 871342038. Thank you.');</script>";
		echo "<script>window.location = 'index';</script>";
	}
	?>
</body>
</html>