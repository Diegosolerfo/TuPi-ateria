<?php
namespace App\modelos;

use PDO;
use PDOException;

    class Conexion {
        public static function getConexion(){
            $conexion = null;
            try{
                $conexion = new PDO("mysql:host=localhost;dbname=proyecto_pi", "root", "contra123P*w");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Error de conexion: " . $e->getMessage();
            }
            return $conexion;
        }
    }

