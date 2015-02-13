<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blingo Metasearch Engine Feedback</title>
<link href="blingostyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
    $q1 = $_POST['1'];
	$q2 = $_POST['2'];
	$q3 = $_POST['3'];
	$q4 = $_POST['4'];
	$q5 = $_POST['5'];
	$q6 = $_POST['6'];
	$q7 = $_POST['7'];
	$q8 = $_POST['8'];
	$q9 = $_POST['9'];
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$to = "davidbreenwex@gmail.com";
    $subject = "Blingo Feedback from: $name";
    $body = "From: $name \n\n Q1: $q1 \n Q2: $q2 \n Q3: $q3 \n Q4: $q4 \n Q5: $q5 \n Q6: $q6 \n Q7: $q7 \n Q8: $q8 \n Q9: $q9 \n Comments: \n $comment";
var_dump($body);
    $sent = mail($to, $subject, $body);
   	if($sent)
    	echo "<script>window.location = 'success.html';</script>";
    else
    	echo "<script>window.location = 'failure.html';</script>";
	?>

</body>
</html>