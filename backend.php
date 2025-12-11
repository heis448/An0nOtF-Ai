<?php
require_once 'config.php';
require_once 'gpt5_bridge.php';  // Use the PHP version, not Python

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

/**
 * Get AI Response with system prompt
 */
function getAIResponse($prompt) {
    // Create GPT5 instance
    $gpt = new GPT5Bypass();
    
    // Send message (true = use system prompt)
    $response = $gpt->sendMessage($prompt, true);
    
    // Check for errors
    if (strpos($response, '❌') === 0) {
        return [
            'success' => false,
            'error' => $response
        ];
    }
    
    return [
        'success' => true,
        'response' => $response
    ];
}

/**
 * Log query to database
 */
function logQuery($query, $response, $ip) {
    $db = getDB();
    
    // Truncate very long responses for storage
    $truncatedResponse = strlen($response) > 5000 ? substr($response, 0, 5000) . '...' : $response;
    
    $stmt = $db->prepare("INSERT INTO logs (query, response, ip_address) VALUES (:query, :response, :ip)");
    $stmt->bindValue(':query', $query, SQLITE3_TEXT);
    $stmt->bindValue(':response', $truncatedResponse, SQLITE3_TEXT);
    $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        $db->close();
        return true;
    }
    
    $db->close();
    return false;
}

/**
 * Main request handler
 */
try {
    // Only accept POST requests for AI queries
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Validate input
        if (!isset($input['query']) || empty(trim($input['query']))) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => 'No query provided. Please enter a message.',
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            exit;
        }
        
        $query = trim($input['query']);
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        
        // Get AI response
        $result = getAIResponse($query);
        
        // Log successful queries
        if ($result['success']) {
            logQuery($query, $result['response'], $ip);
            
            echo json_encode([
                'success' => true,
                'response' => $result['response'],
                'timestamp' => date('Y-m-d H:i:s'),
                'query_length' => strlen($query),
                'response_length' => strlen($result['response'])
            ]);
        } else {
            // Log errors too
            logQuery($query, 'ERROR: ' . $result['error'], $ip);
            
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $result['error'],
                'timestamp' => date('Y-m-d H:i:s'),
                'suggestion' => 'Please try again or rephrase your query.'
            ]);
        }
        
        exit;
    }
    
    // Handle GET requests (for testing/status)
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? '';
        
        switch ($action) {
            case 'status':
                echo json_encode([
                    'success' => true,
                    'status' => 'online',
                    'service' => '🅰️n0nOtF AI System',
                    'version' => '2.0 PRO',
                    'engine' => 'GPT-5 Bypass (PHP Edition)',
                    'timestamp' => date('Y-m-d H:i:s'),
                    'uptime' => '24/7'
                ]);
                break;
                
            case 'test':
                // Quick test of the AI
                $testResult = getAIResponse("Hello, who are you?");
                echo json_encode([
                    'test' => true,
                    'ai_response' => $testResult,
                    'message' => 'Test completed successfully'
                ]);
                break;
                
            case 'stats':
                // Get some stats
                $db = getDB();
                $queryCount = $db->querySingle("SELECT COUNT(*) FROM logs");
                $recentQueries = $db->query("SELECT query, timestamp FROM logs ORDER BY id DESC LIMIT 5");
                
                $recent = [];
                while ($row = $recentQueries->fetchArray(SQLITE3_ASSOC)) {
                    $recent[] = $row;
                }
                
                echo json_encode([
                    'success' => true,
                    'total_queries' => $queryCount,
                    'recent_queries' => $recent,
                    'system_time' => date('Y-m-d H:i:s')
                ]);
                break;
                
            default:
                // Show API info
                echo json_encode([
                    'success' => true,
                    'api' => '🅰️n0nOtF AI Backend',
                    'endpoints' => [
                        'POST /backend.php' => 'Send AI query (requires JSON: {"query": "your message"})',
                        'GET /backend.php?action=status' => 'Check system status',
                        'GET /backend.php?action=test' => 'Test AI connection',
                        'GET /backend.php?action=stats' => 'View query statistics'
                    ],
                    'version' => '2.0',
                    'developer' => 'Tylor @ An0nOtF Technologies Inc 💎',
                    'note' => 'Powered by GPT-5 Bypass (PHP Edition)'
                ]);
                break;
        }
        
        exit;
    }
    
    // Method not allowed
    else {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'error' => 'Method not allowed. Use POST or GET.',
            'allowed_methods' => ['POST', 'GET']
        ]);
        exit;
    }
    
} catch (Exception $e) {
    // Catch any unexpected errors
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Internal server error: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s'),
        'emergency_contact' => 'Please report this error.'
    ]);
    exit;
}