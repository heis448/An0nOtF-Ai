<?php
function callGPT5($prompt) {
    $escaped_prompt = escapeshellarg($prompt);
    $command = "python3 Gpt5.py --query " . $escaped_prompt . " 2>&1";
    
    $output = shell_exec($command);
    
    if ($output === null) {
        return ['success' => false, 'error' => 'Failed to execute Python script'];
    }
    
    $output = trim($output);
    
    if (empty($output)) {
        return ['success' => false, 'error' => 'No response from AI'];
    }
    
    if (strpos($output, '❌') === 0) {
        return ['success' => false, 'error' => $output];
    }
    
    return ['success' => true, 'response' => $output];
}

function testGPT5() {
    $test = callGPT5("Hello, who are you?");
    if ($test['success']) {
        echo "✅ GPT-5 Working! Response: " . substr($test['response'], 0, 100) . "...";
    } else {
        echo "❌ GPT-5 Failed: " . $test['error'];
    }
}
?>