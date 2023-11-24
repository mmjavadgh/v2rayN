<?php

$telegramBotToken = '6520725138:AAF9YpmlJ0ypzFyZwaNr0hf_60xh9RW_kFc';
$channelId = '@TVCminer'; // یا شناسه کانال مثل '-1001234567890'

// Fetch the messages from the Telegram channel
$apiUrl = "https://api.telegram.org/bot{$telegramBotToken}/getChatHistory?chat_id={$channelId}&limit=10";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
 
// Extract V2Ray links from messages and append to links.txt
$links = [];
foreach ($data['result']['messages'] as $message) {
    if (isset($message['text'])) {
        preg_match_all('/vmess:\/\/[^\s]+/', $message['text'], $matches);
        $links = array_merge($links, $matches[0]);
    }
}

if (!empty($links)) {
    file_put_contents('links.txt', implode("\n", $links));
}

?>
