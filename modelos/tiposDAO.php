<?php
namespace App\modelos;

use PDO;
use PDOException;
use App\modelos\Conexion;
use App\modelos\TiposDTO;

class TiposDAO {
    private $conexion;
    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }
    public function registrarTipo(TiposDTO $tipo){
        $sql = "INSERT INTO tipos (NOMBRE, DESCRIPCION, EVENTO)
                VALUES (?, ?, ?);";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(1, $tipo->getNombre());
            $stmt->bindParam(2, $tipo->getDescripcion());
            $stmt->bindParam(3, $tipo->getEvento());
            return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al registrar tipo de producto: " . $e->getMessage();
            }
        }
        public function obtenerTipo($id) {
            $sql = "SELECT * FROM tipos WHERE ID = ?;";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al obtener producto: " . $e->getMessage();
            }
        }
        public function listarTipos() {
            $sql = "SELECT * FROM tipos;";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al listar tipos de productos: " . $e->getMessage();
            }
        }
        public function actualizarTipo(TiposDTO $tipo){
            $id = $tipo->getId();
            $nombre = $tipo->getNombre();
            $descripcion = $tipo->getDescripcion();
            $evento = $tipo->getEvento();
            $sql = "UPDATE tipos
                    SET NOMBRE = ?, DESCRIPCION = ?, EVENTO = ?
                    WHERE ID = ?;";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $descripcion);
                $stmt->bindParam(3, $evento);
                $stmt->bindParam(4, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al actualizar tipo: " . $e->getMessage();
            }
        }
        public function eliminarTipo($id){
            $sql = "DELETE FROM tipos WHERE ID = ?;";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al eliminar producto: " . $e->getMessage();
            }
        }
    }
 
