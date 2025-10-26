<?php
    require_once 'conexion.php';
    require_once 'productosdto.php';

    class productosdao{
        public function registrar_producto(productosdto $productosdto) {
            $conexion = conexion::getConexion();
            $nombre = $productosdto->getNombre();
            $descripcion = $productosdto->getDescripcion();
            $precio = $productosdto->getPrecio();
            $especificaciones = $productosdto->getEspecificaciones();
            $tipo_producto = $productosdto->getTipoProducto();
            var_dump($tipo_producto);
            $sql = "INSERT INTO productos (NOMBRE, DESCRIPCION, PRECIO, ESPECIFICACIONES, TIPO_PRODUCTO)
                    VALUES (?, ?, ?, ?, ?);";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $descripcion);
                $stmt->bindParam(3, $precio);
                $stmt->bindParam(4, $especificaciones);
                $stmt->bindParam(5, $tipo_producto);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al registrar producto: " . $e->getMessage();
            }
        }
        public function obtener_producto($id) {
            $conexion = conexion::getConexion();
            $sql = "SELECT * FROM productos WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al obtener producto: " . $e->getMessage();
            }
        }
        public function listar_productos() {
            $conexion = conexion::getConexion();
            $sql = "SELECT * FROM productos;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al listar productos: " . $e->getMessage();
            }
        }
        public function actualizar_producto(productosdto $productosdto){
            $conexion = conexion::getConexion();
            $id = $productosdto->getId();
            $nombre = $productosdto->getNombre();
            $descripcion = $productosdto->getDescripcion();
            $precio = $productosdto->getPrecio();
            $especificaciones = $productosdto->getEspecificaciones();
            $tipo_producto = $productosdto->getTipoProducto();
            $sql = "UPDATE productos
                    SET NOMBRE = ?, DESCRIPCION = ?, PRECIO = ?, ESPECIFICACIONES = ?, TIPO_PRODUCTO = ?
                    WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $descripcion);
                $stmt->bindParam(3, $precio);
                $stmt->bindParam(4, $especificaciones);
                $stmt->bindParam(5, $tipo_producto);
                $stmt->bindParam(6, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al actualizar producto: " . $e->getMessage();
            }
        }
        public function eliminar_producto($id){
            $conexion = conexion::getConexion();
            $sql = "DELETE FROM productos WHERE ID = ?;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(1, $id);
                return $stmt->execute();
            } catch (PDOException $e) {
                return "Error al eliminar producto: " . $e->getMessage();
            }
        }
    }