<?php 
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Seoul');
 
require('PHPMailer-master/PHPMailerAutoload.php');
 $addr=$_REQUEST["addr"];
 $text=$_REQUEST["text"];
//Create a new PHPMailer instance
$mail = new PHPMailer;
 
//Tell PHPMailer to use SMTP
$mail->isSMTP();
 
$mail->SMTPSecure = 'tls';
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
 
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
 
//Set the hostname of the mail server
$mail->Host = 'smtp.naver.com';
 
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
 
//Set the encryption system to use - ssl (deprecated) or tls
 
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
 
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "tig02389";
 
//Password to use for SMTP authentication
$mail->Password = "gsvv9co!";
 
//Set who the message is to be sent from
$mail->setFrom('tig02389@naver.com', 'test');
 
//Set an alternative reply-to address
$mail->addReplyTo($addr, 'First Last');
 
//Set who the message is to be sent to
$mail->addAddress($addr);
 
//Set the subject line
$mail->Subject = 'personal identification mail.';
 
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("SecurityCharacter is $text", dirname(__FILE__));
 
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
 
//Attach an image file
 
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    echo "<script>window.close()</script>";
}

?>