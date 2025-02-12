<?php
// PayPal IPN კონფიგურაცია
$paypal_url = "https://ipnpb.paypal.com/cgi-bin/webscr"; // LIVE URL
//$paypal_url = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr"; // TEST MODE

// მიიღე PayPal-დან მონაცემები
$post_data = file_get_contents("php://input");
$req = 'cmd=_notify-validate&' . $post_data;

// ვალიდაციის გაგზავნა PayPal-ს
$ch = curl_init($paypal_url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
$res = curl_exec($ch);
curl_close($ch);

if (strcmp($res, "VERIFIED") == 0) {
    // გადამხდელის ინფორმაცია
    $payer_email = $_POST['payer_email'];  // გადამხდელის Email
    $product_id = $_POST['item_number'];   // Product ID (PayPal-დან მიღებული)
    $payment_status = $_POST['payment_status']; // "Completed" თუ გადახდა წარმატებულია

    if ($payment_status == "Completed") {
        // JSON ბაზიდან მონაცემების წამოღება
        $json_file = "products.json";
        if (file_exists($json_file)) {
            $json_data = json_decode(file_get_contents($json_file), true);
            
            if (isset($json_data[$product_id])) {
                $youtube_link = $json_data[$product_id];

                // Email-ის გაგზავნა გადამხდელისთვის
                $to = $payer_email;
                $subject = "Your Access Link";
                $message = "Thank you for your purchase! Here is your private YouTube link: " . $youtube_link;
                $headers = "From: sales@yourwebsite.com\r\nContent-Type: text/plain; charset=UTF-8";

                mail($to, $subject, $message, $headers);
            }
        }
    }
}
?>

