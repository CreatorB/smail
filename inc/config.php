<?php
session_start();

function loadEnv($path) {
    if (!file_exists($path)) {
        throw new Exception("File .env not found.");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
        }
    }
}

loadEnv(__DIR__ . '/.env');

$environment = getenv('ENVIRONMENT');
$base_domain = getenv('BASE_DOMAIN');
$hostname_server = str_replace('${BASE_DOMAIN}', $base_domain, getenv('HOSTNAME_SERVER'));
$hostname_local = getenv('HOSTNAME_LOCAL');

if ($environment === 'production') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    $hostname = $hostname_server;
} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $hostname = $hostname_local;
}

$cpanel_host = str_replace('${BASE_DOMAIN}', $base_domain, getenv('CPANEL_HOST'));
$cpanel_username = getenv('CPANEL_USERNAME');
$cpanel_password = getenv('CPANEL_PASSWORD');
$cpanel_port = getenv('CPANEL_PORT');

function log_error($message) {
    $error_log_path = getenv('ERROR_LOG_PATH');
    file_put_contents($error_log_path, date('Y-m-d H:i:s') . ': ' . $message . PHP_EOL, FILE_APPEND);
}

if (!isset($_SESSION['syathiby_css'])) {
    $current_hour = date('H_i_s');
    $_SESSION['syathiby_css'] = "1_{$current_hour}";
}

$get_current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
define('URL_OFFICIAL', str_replace('${BASE_DOMAIN}', $base_domain, getenv('URL_OFFICIAL')));
define('BASE_URL', $hostname);
define('TIMEOUT', getenv('TIMEOUT'));
define('PATH_ROOT_CSS', str_replace('${HOSTNAME_SERVER}', $hostname_server, getenv('PATH_ROOT_CSS')));
define('PATH_ROOT_JS', str_replace('${HOSTNAME_SERVER}', $hostname_server, getenv('PATH_ROOT_JS')));
define('PATH_ROOT_CSS_CREATORBE', PATH_ROOT_CSS . '/creatorbe.css?v=' . $_SESSION['syathiby_css']);
define('PATH_ROOT_JS_CREATORBE', PATH_ROOT_JS . '/creatorbe.js');

global $koneksi;
$nameserver = getenv('NAMESERVER');
if ($environment === 'production') {
    $username = getenv('USERNAME_PROD');
    $password = getenv('PASSWORD_PROD');
    $namadb = getenv('NAMADB_PROD');
} else {
    $username = getenv('USERNAME_LOCAL');
    $password = getenv('PASSWORD_LOCAL');
    $namadb = getenv('NAMADB_LOCAL');
}
$koneksi = mysqli_connect($nameserver, $username, $password, $namadb);
if (!$koneksi) {
    die("Maintenance : Couldn't connect to $nameserver :" . mysqli_connect_error());
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateEmailDomain($email) {
    $domain = substr(strrchr($email, "@"), 1);
    return ($domain === getenv('BASE_DOMAIN'));
}