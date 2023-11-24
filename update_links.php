<?php

$telegramBotToken = '6520725138:AAF9YpmlJ0ypzFyZwaNr0hf_60xh9RW_kFc';
$channelId = '@TVCminer'; // یا شناسه کانال مثل '-1001234567890'

// Fetch the messages from the Telegram channel
$apiUrl = "https://api.telegram.org/bot{$telegramBotToken}/getChatHistory?chat_id={$channelId}&limit=1"; // تنها آخرین پیام
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Extract all text from the last message and append to links.txt
$texts = [];
if (isset($data['result']['messages'][0]['text'])) {
    // Extract all text from the text
    $texts[] = $data['result']['messages'][0]['text'];
}

// Append texts to the existing links.txt file
if (!empty($texts)) {
    // Write the texts to links.txt
    file_put_contents('/home/runner/work/v2ray/v2ray/links.txt', implode("\n", $texts));
}

?>
