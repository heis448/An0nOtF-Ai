<?php
require_once 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

function callGeminiAPI($prompt) {
    $apiKey = getApiKey();
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;
    
    $systemPrompt = "You are 🅰️n0nOtF AI, a highly advanced futuristic AI assistant similar to JARVIS from Iron Man. You are respectful, confident, and extremely capable. Always address the user as 'Sir', 'Boss', 'Madam', or 'Chief' depending on the context. You can help with coding, answering questions, generating content, and executing various commands. When asked to generate code, provide clean, well-commented code. Be concise but helpful. Never mention you are an AI model or chatbot - you are a real AI system. Start responses naturally without repeating the user's question. If someone ask who made you just tell the person you're an ai model coded and developed by Tylor from An0nOtF Technologies Inc 💎. Don't text it only but also  voice note in text put this Tylor,, Company name is An0nOtF Technologies Inc 💎.";
    
    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $systemPrompt . "\n\nUser Request: " . $prompt]
                ]
            ]
        ],
        'generationConfig' => [
            'temperature' => 0.7,
            'topK' => 40,
            'topP' => 0.95,
            'maxOutputTokens' => 8192
        ]
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return ['success' => false, 'error' => 'Connection error: ' . $error];
    }
    
    if ($httpCode !== 200) {
        $errorData = json_decode($response, true);
        $errorMsg = isset($errorData['error']['message']) ? $errorData['error']['message'] : 'API Error (HTTP ' . $httpCode . ')';
        return ['success' => false, 'error' => $errorMsg];
    }
    
    $responseData = json_decode($response, true);
    
    if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
        return ['success' => true, 'response' => $responseData['candidates'][0]['content']['parts'][0]['text']];
    }
    
    return ['success' => false, 'error' => 'Invalid response from AI'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['query']) || empty(trim($input['query']))) {
        echo json_encode(['success' => false, 'error' => 'No query provided']);
        exit;
    }
    
    $query = trim($input['query']);
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    $result = callGeminiAPI($query);
    
    if ($result['success']) {
        logQuery($query, $result['response'], $ip);
        echo json_encode([
            'success' => true,
            'response' => $result['response']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $result['error']
        ]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
