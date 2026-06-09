<?php
namespace JPOConnect\Database;
use PDO;

class Database {
    private static $instance = null;
    private PDO $pdo;

    private function __construct() {
    // Chemin absolu vers le .env
    $env = parse_ini_file(__DIR__ . '/../../Config/.env');
    
    try {
        $this->pdo = new PDO(
            "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8",
            $env['DB_USER'],
            $env['DB_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    } catch (\PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnexion(): PDO {
        return $this->pdo;
    }
}