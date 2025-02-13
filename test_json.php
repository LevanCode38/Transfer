<?php
// JSON ფაილის ჩატვირთვა
$json_file = "products.json";

// JSON მონაცემების წაკითხვა
$json_data = json_decode(file_get_contents($json_file), true);

// საძიებელი Product ID (მაგალითად, PayPal-დან მიღებული Product ID)
$product_id = "14"; 

// JSON-ში Product ID-ის მოძებნა
if (isset($json_data[$product_id])) {
    echo "✅ ნაპოვნია: " . $json_data[$product_id];
} else {
    echo "❌ ვერ მოიძებნა!";
}
?>
