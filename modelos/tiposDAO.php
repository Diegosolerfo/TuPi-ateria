<?php
    require_once 'conexion.php';
    require_once 'tiposDAO.php';

    class tiposdao{
        public function registrar_tipo(tiposdto $tipo){
            $conexion = conexion::getConexion();
            $sql = "INSERT INTO tipos (NOMBRE, DESCRIPCION, EVENTO)
                    VALUES (?, ?, ?);";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $tipo->getNombre());
                $stmt->bindParam(2, $tipo->getDescripcion());
                $stmt->bindParam(3, $tipo->getEvento());
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al registrar tipo de producto: " . $e->getMessage();
            }
        }
        public function obtener_tipo($id) {
            $conexion = conexion::getConexion();
            $sql = "SELECT * FROM tipos WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al obtener producto: " . $e->getMessage();
            }
        }
        public function listar_tipos() {
            $conexion = conexion::getConexion();
            $sql = "SELECT * FROM tipos;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al listar tipos de productos: " . $e->getMessage();
            }
        }
        public function actualizar_tipo(tiposdto $tipo){
            $conexion = conexion::getConexion();
            $id = $tipo->getId();
            $nombre = $tipo->getNombre();
            $descripcion = $tipo->getDescripcion();
            $evento = $tipo->getEvento();
            $sql = "UPDATE tipos
                    SET NOMBRE = ?, DESCRIPCION = ?, EVENTO = ?
                    WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $descripcion);
                $stmt->bindParam(3, $evento);
                $stmt->bindParam(4, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al actualizar tipo: " . $e->getMessage();
            }
        }
        public function eliminar_tipo($id){
            $conexion = conexion::getConexion();
            $sql = "DELETE FROM tipos WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al eliminar producto: " . $e->getMessage();
            }
        }
    }