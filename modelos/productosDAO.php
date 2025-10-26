<?php
namespace App\modelos;

use PDO;
use PDOException;
use App\modelos\Conexion;
use App\modelos\ProductosDTO;

class ProductosDAO {
        public function registrar_producto(ProductosDTO $productosDTO) {
            $conexion = Conexion::getConexion();
            $nombre = $productosDTO->getNombre();
            $descripcion = $productosDTO->getDescripcion();
            $precio = $productosDTO->getPrecio();
            $especificaciones = $productosDTO->getEspecificaciones();
            $tipo_producto = $productosDTO->getTipoProducto();
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
            $conexion = Conexion::getConexion();
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
            $conexion = Conexion::getConexion();
            $sql = "SELECT * FROM productos;";
            try {
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return "Error al listar productos: " . $e->getMessage();
            }
        }
        public function actualizar_producto(ProductosDTO $productosDTO){
            $conexion = Conexion::getConexion();
            $id = $productosDTO->getId();
            $nombre = $productosDTO->getNombre();
            $descripcion = $productosDTO->getDescripcion();
            $precio = $productosDTO->getPrecio();
            $especificaciones = $productosDTO->getEspecificaciones();
            $tipo_producto = $productosDTO->getTipoProducto();
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