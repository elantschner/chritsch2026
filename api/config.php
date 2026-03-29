<?php
/**
 * API Configuration – mysqli, JSON helpers, Rate Limiting
 */

// ─── Environment detection ───────────────────────────────────────────────────
$_serverName = $_SERVER['SERVER_NAME'] ?? '';
$isLocal = (in_array($_serverName, ['localhost', '127.0.0.1', ''], true)
         || strpos($_serverName, '192.168.') === 0);

// ─── CORS ────────────────────────────────────────────────────────────────────
$allowedOrigin = $isLocal ? '*' : 'https://www.chritsch.at';
header('Access-Control-Allow-Origin: ' . $allowedOrigin);
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ─── Load .env ───────────────────────────────────────────────────────────────
$_env = parse_ini_file(__DIR__ . '/../admin/.env');
if ($_env === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => '.env nicht gefunden']);
    exit;
}

// ─── DB Credentials ──────────────────────────────────────────────────────────
$_prefix = $isLocal ? 'LOCAL_' : 'PROD_';
define('DB_HOST', $_env[$_prefix . 'DB_HOST']);
define('DB_NAME', $_env[$_prefix . 'DB_NAME']);
define('DB_USER', $_env[$_prefix . 'DB_USER']);
define('DB_PASS', $_env[$_prefix . 'DB_PASS']);



// ─── mysqli Singleton ────────────────────────────────────────────────────────
function getDB()
{
    static $db = null;
    if ($db !== null) return $db;

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($db->connect_error) {
        sendError('Datenbankverbindung fehlgeschlagen: ' . $db->connect_error, 500);
    }

    $db->set_charset('utf8mb4');
    return $db;
}

// ─── JSON Response Helpers ───────────────────────────────────────────────────
function sendJSON(bool $success, $data = null, array $meta = [])
{
    $response = ['success' => $success];
    if ($data !== null) $response['data'] = $data;
    if (!empty($meta))  $response = array_merge($response, $meta);
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function sendError(string $message, int $code = 400)
{
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

// ─── File-based Rate Limiting ────────────────────────────────────────────────
function rateLimit(string $action, int $max = 5, int $windowSeconds = 3600)
{
    $ip  = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $action . '_' . $ip);
    $dir = sys_get_temp_dir() . '/chritsch_ratelimit/';

    if (!is_dir($dir)) mkdir($dir, 0700, true);

    $file = $dir . $key . '.json';
    $now  = time();

    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        $data['hits'] = array_values(array_filter(
            $data['hits'] ?? [],
            function($t) use ($now, $windowSeconds) { return ($now - $t) < $windowSeconds; }
        ));
    } else {
        $data = ['hits' => []];
    }

    if (count($data['hits']) >= $max) {
        sendError('Zu viele Anfragen. Bitte warte etwas und versuche es erneut.', 429);
    }

    $data['hits'][] = $now;
    file_put_contents($file, json_encode($data));
}

// ─── SMTP Credentials ────────────────────────────────────────────────────────
define('SMTP_HOST',      $_env['SMTP_HOST']);
define('SMTP_USER',      $_env['SMTP_USER']);
define('SMTP_PASS',      $_env['SMTP_PASS']);
define('SMTP_PORT',      (int) $_env['SMTP_PORT']);
define('SMTP_FROM',      $_env['SMTP_FROM']);
define('SMTP_FROM_NAME', $_env['SMTP_FROM_NAME']);
define('MAIL_TO',        $_env['MAIL_TO']);
