<?php
// გადახდის Product ID (PayPal-დან მიღებული)
$product_id = $_POST['item_number'] ?? '';  

// JSON ფაილის ჩატვირთვა
$json_file = "products.json";
$json_data = json_decode(file_get_contents($json_file), true);

// JSON-ში Product ID-ის მოძებნა
if (isset($json_data[$product_id])) {
    $youtube_link = $json_data[$product_id];
    echo "გადახდის ლინკი: " . $youtube_link;
} else {
    echo "პროდუქტი ვერ მოიძებნა!";
}
?>
