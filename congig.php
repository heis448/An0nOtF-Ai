<?php
session_start();

define('DB_FILE', __DIR__ . '/database.sqlite');
define('ADMIN_USERNAME', 'An0nOtF');
define('ADMIN_PASSWORD', '@Heistech1');

function getDB() {
    $db = new SQLite3(DB_FILE);
    $db->exec("CREATE TABLE IF NOT EXISTS settings (
        id INTEGER PRIMARY KEY,
        setting_key TEXT UNIQUE,
        setting_value TEXT
    )");
    $db->exec("CREATE TABLE IF NOT EXISTS logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        query TEXT,
        response TEXT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        ip_address TEXT
    )");
    return $db;
}

function getApiKey() {
    return 'GPT-5-Mini via Claila Bypass';
}

function setApiKey($key) {
    return true;
}

function logQuery($query, $response, $ip) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO logs (query, response, ip_address) VALUES (:query, :response, :ip)");
    $stmt->bindValue(':query', $query, SQLITE3_TEXT);
    $stmt->bindValue(':response', $response, SQLITE3_TEXT);
    $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}

function getLogs($limit = 100) {
    $db = getDB();
    $result = $db->query("SELECT * FROM logs ORDER BY timestamp DESC LIMIT " . intval($limit));
    $logs = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $logs[] = $row;
    }
    $db->close();
    return $logs;
}

function clearLogs() {
    $db = getDB();
    $db->exec("DELETE FROM logs");
    $db->close();
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}
?>