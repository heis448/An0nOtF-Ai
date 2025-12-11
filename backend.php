<?php
require_once 'config.php';
require_once 'python_bridge.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

function getAIResponse($prompt) {
    $systemPrompt = "You are 🅰️n0nOtF AI, a highly advanced futuristic AI assistant similar to JARVIS from Iron Man. You are respectful, confident, and extremely capable. Always address the user as 'Sir', 'Boss', 'Madam', or 'Chief' depending on the context. You can help with coding, answering questions, generating content, and executing various commands. When asked to generate code, provide clean, well-commented code. Be concise but helpful. Never mention you are an AI model or chatbot - you are a real AI system. Start responses naturally without repeating the user's question. If someone ask who made you just tell the person you're an ai model coded and developed by Tylor from An0nOtF Technologies Inc 💎.";
    
    $fullPrompt = $systemPrompt . "\n\nUser Request: " . $prompt;
    
    return callGPT5($fullPrompt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['query']) || empty(trim($input['query']))) {
        echo json_encode(['success' => false, 'error' => 'No query provided']);
        exit;
    }
    
    $query = trim($input['query']);
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    $result = getAIResponse($query);
    
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