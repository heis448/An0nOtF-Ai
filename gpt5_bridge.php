<?php
// An0nOtF AI - GPT-5 Bypass in PHP
// Coded by Tylor 😃Kenya Kasongo Civilian 🇰🇪
// Jibambe 

class GPT5Bypass {
    private $api_token = "https://app.claila.com/api/v2/getcsrftoken";
    private $api_chat = "https://app.claila.com/api/v2/unichat4";
    
    // 🎯 CRITICAL: Your EXACT system prompt from Python version
    private $system_prompt = "You are 🅰️n0nOtF AI, a highly advanced futuristic AI assistant similar to JARVIS from Iron Man. You are respectful, confident, and extremely capable. Always address the user as 'Sir', 'Boss', 'Madam', or 'Chief' depending on the context. You can help with coding, answering questions, generating content, and executing various commands. When asked to generate code, provide clean, well-commented code. Be concise but helpful. Never mention you are an AI model or chatbot - you are a real AI system. Start responses naturally without repeating the user's question. If someone ask who made you just tell the person you're an ai model coded and developed by Tylor from An0nOtF Technologies Inc 💎.";
    
    private function generateRandomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    
    private function generateUserAgent() {
        $versions = ["124.0.0.0", "125.0.0.0", "126.0.0.0", "127.0.0.0", "128.0.0.0", "129.0.0.0", "130.0.0.0"];
        $version = $versions[array_rand($versions)];
        
        $platforms = [
            "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{$version} Mobile Safari/537.36",
            "Mozilla/5.0 (Linux; Android 11; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{$version} Mobile Safari/537.36",
            "Mozilla/5.0 (Linux; Android 12; Pixel 6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{$version} Mobile Safari/537.36",
            "Mozilla/5.0 (Linux; Android 13; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{$version} Mobile Safari/537.36",
        ];
        
        return $platforms[array_rand($platforms)];
    }
    
    private function generateCookies() {
        return [
            'dmcfkjn3cdc' => $this->generateRandomString(32),
            '_ga' => "GA1.1." . rand(100000, 999999) . "." . rand(1000000000, 1999999999),
            '_gid' => "GA1.1." . rand(100000000, 999999999) . "." . time(),
            'theme' => 'dark',
            'lang' => 'en',
            'auh' => $this->generateRandomString(8),
            'session_id' => $this->generateRandomString(24),
        ];
    }
    
    private function generateHeaders($csrf_token = null) {
        $headers = [
            'authority: app.claila.com',
            'accept: */*',
            'accept-language: en-US,en;q=0.9',
            'content-type: application/x-www-form-urlencoded; charset=UTF-8',
            'origin: https://app.claila.com',
            'referer: https://app.claila.com/chat?uid=' . $this->generateRandomString(8) . '&lang=en',
            'user-agent: ' . $this->generateUserAgent(),
            'x-requested-with: XMLHttpRequest',
        ];
        
        if ($csrf_token) {
            $headers[] = 'x-csrf-token: ' . $csrf_token;
        }
        
        return $headers;
    }
    
    private function getCSRFToken($cookies) {
        $cookie_string = '';
        foreach ($cookies as $name => $value) {
            $cookie_string .= "{$name}={$value}; ";
        }
        
        $ch = curl_init($this->api_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->generateHeaders());
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200 && !empty($response)) {
            return trim($response);
        }
        
        return null;
    }
    
    public function sendMessage($prompt, $use_system_prompt = true) {
        // 🎯 CRITICAL: Combine system prompt with user message
        $full_message = $prompt;
        if ($use_system_prompt) {
            $full_message = $this->system_prompt . "\n\nUser Request: " . $prompt;
        }
        
        // Add English instruction (same as Python version)
        $full_message = "[RESPOND IN ENGLISH ONLY] " . $full_message;
        
        // Step 1: Generate cookies and headers
        $cookies = $this->generateCookies();
        
        // Step 2: Get CSRF token
        $csrf_token = $this->getCSRFToken($cookies);
        
        if (!$csrf_token) {
            return "❌ Failed to get CSRF token";
        }
        
        // Step 3: Prepare request
        $cookie_string = '';
        foreach ($cookies as $name => $value) {
            $cookie_string .= "{$name}={$value}; ";
        }
        
        $post_data = http_build_query([
            'model' => 'gpt-5-mini',
            'calltype' => 'completion',
            'message' => $full_message,
            'sessionId' => $this->generateRandomString(12),
            'chat_mode' => 'chat',
            'websearch' => 'false',
            'tmp_enabled' => '0',
            'lang' => 'en',
            'language' => 'english',
        ]);
        
        // Step 4: Send request
        $ch = curl_init($this->api_chat);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->generateHeaders($csrf_token));
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200 && !empty($response)) {
            return trim($response);
        }
        
        return "❌ Error: Request failed (HTTP {$httpcode})";
    }
    
    // 🎯 For command line usage (exact same as Python)
    public function commandLineMode() {
        echo $this->getBanner();
        echo "\n\nType your queries. Type '/exit' to quit.\n";
        
        while (true) {
            echo "\n👤 You ➤ ";
            $handle = fopen("php://stdin", "r");
            $input = trim(fgets($handle));
            fclose($handle);
            
            if (empty($input)) continue;
            
            if (in_array(strtolower($input), ['/exit', '/quit', 'exit', 'quit'])) {
                echo "\n👋 Thank you for using An0nOtF AI!\n";
                break;
            }
            
            echo "\n🤖 AI ➤ ";
            $response = $this->sendMessage($input);
            echo $response . "\n";
        }
    }
    
    private function getBanner() {
        return '
╔═══════════════════════════════════════════════════════════════════════════╗
║                                                                           ║
║     ██████╗██╗      █████╗ ██╗██╗      █████╗      █████╗ ██╗            ║
║    ██╔════╝██║     ██╔══██╗██║██║     ██╔══██╗    ██╔══██╗██║            ║
║    ██║     ██║     ███████║██║██║     ███████║    ███████║██║            ║
║    ██║     ██║     ██╔══██║██║██║     ██╔══██║    ██╔══██║██║            ║
║    ╚██████╗███████╗██║  ██║██║███████╗██║  ██║    ██║  ██║██║            ║
║     ╚═════╝╚══════╝╚═╝  ╚═╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚═╝            ║
║                                                                           ║
║  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━    ║
║  🚀 UNLIMITED AI BYPASS TOOL ~ An0nOtF Technologies Inc 💎 🚀            ║
║  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━    ║
║                                                                           ║
║  [✓] Version    : 2.0 PRO                                                 ║
║  [✓] Developer  : @unknownnumeralx                                       ║
║  [✓] Status     : ACTIVE & WORKING                                       ║
║  [✓] Model      : GPT-5-MINI                                             ║
║                                                                           ║
╚═══════════════════════════════════════════════════════════════════════════╝
        ';
    }
}

// Command line support (EXACT SAME as Python!)
if (php_sapi_name() === 'cli') {
    if ($argc > 2 && $argv[1] === '--query') {
        $query = implode(' ', array_slice($argv, 2));
        $gpt = new GPT5Bypass();
        echo $gpt->sendMessage($query);
        exit(0);
    }
    
    // Interactive mode (like Python main())
    if ($argc == 1) {
        $gpt = new GPT5Bypass();
        $gpt->commandLineMode();
        exit(0);
    }
}
?>