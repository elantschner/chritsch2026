<?PHP
date_default_timezone_set("Europe/Rome");

$_env = parse_ini_file(__DIR__ . '/.env');

$_serverName = $_SERVER['SERVER_NAME'] ?? '';
$_isLocal = (in_array($_serverName, ['localhost', '127.0.0.1', ''], true)
          || strpos($_serverName, '192.168.') === 0);
$_prefix = $_isLocal ? 'LOCAL_' : 'PROD_';

$host     = $_env[$_prefix . 'DB_HOST'];
$user     = $_env[$_prefix . 'DB_USER'];
$pass     = $_env[$_prefix . 'DB_PASS'];
$database = $_env[$_prefix . 'DB_NAME'];

$dz = mysqli_connect($host, $user, $pass);
mysqli_select_db($dz, $database);
mysqli_set_charset($dz, "UTF8");
?>