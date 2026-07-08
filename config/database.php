<?php
// Lee las variables de entorno de la nube o usa los valores locales por defecto
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_NAME', getenv('DB_NAME') ?: 'inmocasa');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_PORT', getenv('DB_PORT') ?: '3307');

class Database
{
    private static $conn = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public static function getConexion()
    {
        if (self::$conn === null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST .
                    ';port=' . DB_PORT .
                    ';dbname=' . DB_NAME .
                    ';charset=utf8';

                self::$conn = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Error de conexion: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>