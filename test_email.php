<?php
$to = "შენი იმეილი აქ";  
$subject = "Test Email";  
$message = "თუ ეს მიიღო, Email მუშაობს!";
$headers = "From: sales@yourwebsite.com\r\nContent-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Email გაგზავნილია!";
} else {
    echo "❌ Email ვერ გაიგზავნა!";
}
?>
