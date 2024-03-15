<?php

$to = 'vinhlengabay@gmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if ($_POST) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $contact_message = $_POST['message'];

    if ($subject == '') {
        $subject = "Gửi biểu mẫu liên hệ";
    }

    // Set Message
    $message = '';
    $message .= "Từ email: " . $name . "<br />";
    $message .= "Email: " . $email . "<br />";
    $message .= "Nội dung: <br />";
    $message .= nl2br($contact_message);
    $message .= "<br /> ----- <br /> Email này đã được gửi từ trang web của bạn contact form. <br />";

    // Set From: header
    $from = $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $to); // for windows server
    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
        echo "OK";
    } else {
        echo "Đã xảy ra lỗi. Vui lòng thử lại";
    }

}

?>