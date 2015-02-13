<?php
	/*
	*Below is the php code to start a session. Its positioned on top of the header include file which is heads every page in 
	*the site. This is to make sure the session variable $_SESSION['MM_UserGroup'] ,which carries the user role information,
	*is carried on to every page and an administrator or editor only has to log in once. Also as a security measure i have
	*included code to say that if the user role is not set - set it to 0. 
	*/
session_start();
if (isset($_SESSION['MM_UserGroup']))
$_SESSION['MM_UserGroup']=$_SESSION['MM_UserGroup'];
else
$_SESSION['MM_UserGroup']=0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email</title>
</head>

<body>
    <?php
    $to = "davidbreenwex@gmail.com";
    $email = 'david';
    $fname = 'david';
	$lname = 'david';
    $phone = 'david';
    $subject = "Message from: $fname $lname";
    $message = 'no comment';
	$headers = "Message Comments page of GAA Website";
    $body = "From: $fname $lname \n\n Email: $email \n\n Phone Number: $phone \n\n Message: $message";
    $sent = mail($to, $subject, $body, $headers) ;
    if($sent)
    {echo "<script language=javascript>window.location = 'success.html';</script>";}
    else
    {echo "<script language=javascript>window.location = 'failure.html';</script>";}
     
	?>

</body>
</html>