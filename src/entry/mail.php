<?php
$to = "mi3mi3king@icloud.com"; // 宛先のメールアドレス
$subject = "テストメール"; // メールの件名
$message = "これはテストメールです。"; // メールの本文
$headers = "From: mi3mi3king@gmail.com"; // 送信元のメールアドレス

// メールを送信する
if (mail($to, $subject, $message, $headers)) {
    echo "メールが送信されました";
} else {
    echo "メールの送信に失敗しました";
}
?>
