<?php

// Load .env manually line by line
$apiKey = null;
$lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    if (strpos($line, '=') !== false) {
        list($key, $val) = explode('=', $line, 2);
        if (trim($key) === 'GEMINI_API_KEY') {
            $apiKey = trim($val, " \t\n\r\0\x0B\"'");
            break;
        }
    }
}

if (!$apiKey) {
    die("No GEMINI_API_KEY in .env file.\n");
}

$contents = [
    [
        'role' => 'user',
        'parts' => [['text' => 'kabel LAN saya rusak']]
    ]
];

$systemInstruction = "Anda adalah Asisten Virtual Layanan TI BPK RI. Format respons Anda harus SELALU berupa objek JSON yang valid dengan struktur berikut: { \"reply\": \"solusi Anda\", \"recommendation\": null }";

$models = [
    'gemini-3.5-flash',
    'gemini-2.5-flash',
    'gemini-2.5-flash-lite'
];

foreach ($models as $model) {
    echo "\nTesting model: $model\n";
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $apiKey;

    $payload = [
        'contents' => $contents,
        'systemInstruction' => [
            'parts' => [['text' => $systemInstruction]]
        ],
        'generationConfig' => [
            'responseMimeType' => 'application/json',
        ]
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Status Code: $httpCode\n";
    echo "Response:\n$response\n";
}
