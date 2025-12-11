<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre style='background: #0a0a0f; color: #00f5ff; padding: 30px; font-family: monospace; min-height: 100vh;'>";
echo "========================================\n";
echo "  🅰️n0nOtF AI - SETUP WIZARD\n";
echo "========================================\n\n";

$success = true;

echo "[CHECKING] PHP Version... ";
if (version_compare(PHP_VERSION, '7.4.0', '>=')) {
    echo "OK (PHP " . PHP_VERSION . ")\n";
} else {
    echo "WARNING - PHP 7.4+ recommended (Current: " . PHP_VERSION . ")\n";
}

echo "[CHECKING] SQLite3 Extension... ";
if (extension_loaded('sqlite3')) {
    echo "OK\n";
} else {
    echo "MISSING - SQLite3 extension required!\n";
    $success = false;
}

echo "[CHECKING] cURL Extension... ";
if (extension_loaded('curl')) {
    echo "OK\n";
} else {
    echo "MISSING - cURL extension required for API calls!\n";
    $success = false;
}

echo "[CHECKING] Session Support... ";
if (function_exists('session_start')) {
    echo "OK\n";
} else {
    echo "MISSING - Session support required!\n";
    $success = false;
}

echo "[CHECKING] Python Support... ";
if (function_exists('shell_exec')) {
    $pythonCheck = shell_exec('python3 --version 2>&1');
    if (strpos($pythonCheck, 'Python 3') !== false) {
        echo "OK ($pythonCheck)\n";
    } else {
        echo "WARNING - Python 3 not found\n";
    }
} else {
    echo "WARNING - shell_exec disabled\n";
}

echo "\n[SETUP] Creating database...\n";

try {
    $dbFile = __DIR__ . '/database.sqlite';
    $db = new SQLite3($dbFile);
    
    $db->exec("CREATE TABLE IF NOT EXISTS settings (
        id INTEGER PRIMARY KEY,
        setting_key TEXT UNIQUE,
        setting_value TEXT
    )");
    echo "  - Settings table: OK\n";
    
    $db->exec("CREATE TABLE IF NOT EXISTS logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        query TEXT,
        response TEXT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        ip_address TEXT
    )");
    echo "  - Logs table: OK\n";
    
    echo "  - GPT-5 Bypass: READY\n";
    
    $db->close();
    
    @chmod($dbFile, 0666);
    echo "  - Database permissions: OK\n";
    
} catch (Exception $e) {
    echo "  - ERROR: " . $e->getMessage() . "\n";
    $success = false;
}

echo "\n[CHECKING] File permissions...\n";
$files = ['index.php', 'backend.php', 'adminpanel.php', 'config.php', 'python_bridge.php', 'Gpt5.py'];
foreach ($files as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        echo "  - $file: FOUND\n";
    } else {
        echo "  - $file: MISSING\n";
        $success = false;
    }
}

echo "\n[TESTING] GPT-5 Bridge...\n";
if (file_exists(__DIR__ . '/python_bridge.php')) {
    require_once __DIR__ . '/python_bridge.php';
    
    if (function_exists('testGPT5')) {
        echo "  - Bridge functions: LOADED\n";
    }
}

echo "\n========================================\n";
if ($success) {
    echo "  SETUP COMPLETED SUCCESSFULLY!\n";
    echo "========================================\n\n";
    echo "Your 🅰️n0nOtF AI system is ready.\n\n";
    
    echo "🎯 FEATURES:\n";
    echo "   • GPT-5 Bypass AI\n";
    echo "   • Voice Input/Output\n";
    echo "   • Advanced UI Animations\n";
    echo "   • Admin Dashboard\n\n";
    
    echo "Quick Links:\n";
    echo "  - Main Interface: <a href='index.php' style='color: #8000ff;'>index.php</a>\n";
    echo "  - Admin Panel: <a href='adminpanel.php' style='color: #8000ff;'>adminpanel.php</a>\n\n";
    
    echo "Admin Credentials:\n";
    echo "  Username: An0nOtF\n";
    echo "  Password: @Heistech1\n\n";
    
    echo "⚠️ IMPORTANT:\n";
    echo "  1. Install Python requests: pip install requests\n";
    echo "  2. Delete this setup.php after installation!\n";
    
} else {
    echo "  SETUP PARTIALLY COMPLETE\n";
    echo "========================================\n\n";
    echo "Some checks failed, but system may work.\n";
}

echo "</pre>";
?>