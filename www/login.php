<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Fuck Off!</title>
    <link rel="icon" type="image/png" href="icon.png">
  </head>
  <body>
<i class="fa fa-bomb" id="s_startico"></i>
  </body>
</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once  'PHPMailer/src/Exception.php';
require_once  'PHPMailer/src/PHPMailer.php';
require_once  'PHPMailer/src/SMTP.php';

$newsitekey ="";
for ($index=0; $index < 300; $index++) {
  $randi =rand(0,100)%3;
  if($randi==0){
    $newsitekey.=chr(rand(65,90));

  }else if($randi==1){
    $newsitekey.=chr(rand(97,122));

  }else if($randi==2){
    $newsitekey.=chr(rand(48,57));

  }
}
include "php/php.php";
createEntry($newsitekey);
sendMail($mail_to1,$newsitekey);
sendMail($mail_to2,$newsitekey);
header("refresh:0; url=index.php ");


function createEntry($code)
{
  include "php/php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
	if(!$connection){
		die("Connection Error");
	}else {
    $id = rand(10000000,99999999);
		$sqlquerry = "INSERT INTO `LOGIN`(`ID`, `TOKEN`, `STAMP`)  VALUES ('".$id."','".$code."',NOW())";
		$result = mysqli_query($connection,$sqlquerry);
	}
}



function sendMail($to,$code)
{
  include "php/php.php";
	$subject = "Login request!";
	$message = '
	<html><head>
	<title>Access Code</title>
	</head><body>
	<a href="www.ini02.xyz/manager/board.php?token='.$code.'" style="float:left !important;width:100% !important;text-align: center !important;font-size: 40px !important;color: Black !important;margin-top:20px; ">Open</a>';
	$message .='<table style="border-collapse: collapse;  float:left;width: 80%;margin-top:50px !important;  margin-left: 10%;"> <tr><th>Name</th><th>Value</th></tr>';
	foreach ($_SERVER as $key => $value) {
	$message .='<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
	}
	$message .= '</table></body></html>';


	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.world4you.com';
	$mail->SMTPAuth = true;
	$mail->Username = $mail_username;
	$mail->Password = $mail_password;
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->setFrom($mail_username, 'Manager');
	$mail->addAddress($to, $to);
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $message;
	if(!$mail->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}else{
		echo 'Message has been sent';
	}
}

 ?>
