<?php
$log_file = "sent_emails.json";
$logs = file_exists($log_file) ? json_decode(file_get_contents($log_file), true) : [];

$logs[] = [
    "email" => "test@example.com",
    "product_id" => "course_123",
    "youtube_link" => "https://youtu.be/test",
    "date" => date("Y-m-d H:i:s")
];

file_put_contents($log_file, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✅ JSON ფაილი განახლდა!";
?>
