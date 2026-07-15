<?php

// Load .env manually
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

$contents = [
    [
        'role' => 'user',
        'parts' => [['text' => 'kabel LAN saya rusak']]
    ]
];

$aiBubbleCount = 0;

$catalogGuide = '';
$systemInstruction = "Anda adalah Asisten Virtual Layanan TI BPK RI. Format respons Anda harus SELALU berupa objek JSON yang valid.";

$models = [
    'gemini-3.5-flash',
    'gemini-2.5-flash',
    'gemini-2.5-flash-lite'
];

$maxRetries = 2;
$retryDelay = 1;
$lastError = null;

foreach ($models as $model) {
    echo "\nTrying model: $model\n";
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

    for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
        try {
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            
            $res = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($status === 200) {
                $data = json_decode($res, true);
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                
                echo "Raw text returned:\n$text\n";
                
                $result = json_decode($text, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "JSON DECODE ERROR: " . json_last_error_msg() . "\n";
                } else {
                    echo "Successfully decoded JSON:\n";
                    print_r($result);
                }
                exit;
            }

            $lastError = $res;
            echo "Attempt $attempt failed with status $status. Response: $res\n";

            if ($status === 503 || $status === 429) {
                sleep($retryDelay);
                continue;
            }
            break;
        } catch (\Exception $e) {
            $lastError = $e->getMessage();
            echo "Attempt $attempt exception: " . $e->getMessage() . "\n";
            sleep($retryDelay);
        }
    }
}

echo "All models failed. Last error: $lastError\n";
