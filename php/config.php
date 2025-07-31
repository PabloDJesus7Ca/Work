<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


    $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
    $user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
    $password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
    $dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'dblibreria';
    $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? 3306;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    
} catch (PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    die("Error de conexión a la base de datos");
}
?>
