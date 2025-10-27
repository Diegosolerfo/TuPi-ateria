<?php
namespace App\modelos;

use PDO;
use PDOException;

class Conexion {
    private static $instance = null;
    private static $config = null;

    private static function loadConfig() {
        if (self::$config === null) {
            // Use require_once to avoid accidental multiple includes
            self::$config = require_once __DIR__ . '/../config/database.php'; //NOSONAR
        }
        return self::$config;
    }

    public static function getConexion() {
        if (self::$instance === null) {
            try {
                $config = self::loadConfig();
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
                
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                // Log el error de forma segura sin exponer detalles sensibles
                error_log("Error de conexión a la base de datos: " . $e->getMessage());
                throw new PDOException("Error de conexión a la base de datos");
            }
        }
        return self::$instance;
    }
}

