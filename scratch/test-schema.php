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

$systemInstruction = "Anda adalah Asisten Virtual Layanan TI BPK RI.";

$models = [
    'gemini-3.5-flash',
    'gemini-2.5-flash',
    'gemini-2.5-flash-lite'
];

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
            'responseSchema' => [
                'type' => 'OBJECT',
                'properties' => [
                    'reply' => [
                        'type' => 'STRING',
                        'description' => 'Jawaban solusi atau panduan troubleshooting'
                    ],
                    'recommendation' => [
                        'type' => 'OBJECT',
                        'nullable' => true,
                        'properties' => [
                            'category' => ['type' => 'STRING'],
                            'sub' => ['type' => 'STRING'],
                            'service' => ['type' => 'STRING'],
                            'confidence' => ['type' => 'STRING', 'enum' => ['Tinggi', 'Sedang', 'Rendah']]
                        ],
                        'required' => ['category', 'sub', 'service', 'confidence']
                    ]
                ],
                'required' => ['reply']
            ]
        ]
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $res = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "Status: $status\n";
    if ($status === 200) {
        $data = json_decode($res, true);
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
        echo "Response Text:\n$text\n";
    } else {
        echo "Response Error:\n$res\n";
    }
}
