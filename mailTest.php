<?php
/*
$email="sailesh.threadcode@gmail.com";
$v_key=md5(time().$email);
$body="<a href='http://localhost/Online%20Clothing%20Store/Verify.php?key=$v_key'>Click here to verify</a>";


 $to_email = "sailesh.threadcode@gmail.com";
$subject = "Simple Email Test via PHP";
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= "From: Alina Thing";
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
} 
*/

$val="s";
$as=md5($val);
echo ($as);
//echo ("NOCE");
if($as==='03c7c0ace395d80182db'){
    echo ("YES");
}else{
    echo "No";
} 
?>
