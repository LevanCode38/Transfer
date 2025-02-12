<?php
// YouTube private ლინკი (შენ ჩასვი შენი ლინკი)
$youtube_link = "https://www.youtube.com/watch?v=MhA2bfEpGIg";

// PayPal-ისგან მონაცემების მიღება
$raw_post_data = file_get_contents("php://input");
$data = json_decode($raw_post_data, true);

// LOG ფაილში ჩაწერა (დამატებითი Debugging)
file_put_contents("paypal_log.txt", print_r($data, true), FILE_APPEND);

// გადავამოწმოთ გადახდა
if (isset($data['event_type']) && $data['event_type'] == "PAYMENT.SALE.COMPLETED") {
    $payer_email = $data['resource']['payer']['email_address']; // გადამხდელის იმეილი

    if (!empty($payer_email)) {
        sendEmail($payer_email, $youtube_link);
    }
}

// იმეილის გაგზავნა
function sendEmail($to, $link) {
    $subject = "თქვენი YouTube ლინკი გადახდის შემდეგ 🎥";
    $message = "მადლობა გადახდისთვის! თქვენი პირადი YouTube ლინკი: $link";
    $headers = "From: noreply@yourdomain.com\r\n" .
               "Reply-To: support@yourdomain.com\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $message, $headers)) {
        file_put_contents("email_log.txt", "Email sent to $to\n", FILE_APPEND);
    } else {
        file_put_contents("email_log.txt", "Email failed to send to $to\n", FILE_APPEND);
    }
}

?>

