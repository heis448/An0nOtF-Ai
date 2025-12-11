<?php
// This is now just a wrapper for compatibility
require_once 'gpt5_bridge.php';

function callGPT5($prompt) {
    $gpt = new GPT5Bypass();
    $response = $gpt->sendMessage($prompt, true);
    
    if (strpos($response, '❌') === 0) {
        return ['success' => false, 'error' => $response];
    }
    
    return ['success' => true, 'response' => $response];
}

function testGPT5() {
    $test = callGPT5("Hello");
    if ($test['success']) {
        echo "✅ AI System Online!";
    } else {
        echo "❌ AI System Offline: " . $test['error'];
    }
}
?>