<?php
require "PHPMailer/class.phpmailer.php";
function smtp_mail ( $sendto_email, $subject, $body) {
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "smtp.163.com"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "admin@i0day.com"; // SMTP username 注意：普通邮件认证不需要加 @域名
$mail->Password = "123456"; // SMTP password

$mail->From = "admin@i0day"; // 发件人邮箱
$mail->FromName = "Pxss"; // 发件人

$mail->CharSet = "UTF8"; // 这里指定字符集！
$mail->Encoding = "base64";

$mail->AddAddress($sendto_email,"username"); // 收件人邮箱和姓名
//$mail->AddReplyTo("yourmail@jbxue.com","jbxue.com");

//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
$mail->IsHTML(true); // send as HTML
// 邮件主题
$mail->Subject =$subject;
// 邮件内容
$mail->Body = $body;

$mail->AltBody ="text/html";
$mail->Send();
    }

// 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)


?>