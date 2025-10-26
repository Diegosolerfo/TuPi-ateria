<?php
namespace App\modelos;

use PDO;
use PDOException;
use App\modelos\Conexion;
use App\modelos\ProductosDTO;

class ProductosDAO {
    private $conexion;
    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }
    private function ejecutarConsulta(string $sql, array $parametros = [], bool $retornarDatos = false) {
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($parametros);

            if ($retornarDatos) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return true;
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }
    private function extraerDatosProducto(ProductosDTO $p, bool $incluirId = false): array {
        $datos = [
            $p->getNombre(),
            $p->getDescripcion(),
            $p->getPrecio(),
            $p->getEspecificaciones(),
            $p->getTipoProducto()
        ];

        if ($incluirId) {
            $datos[] = $p->getId();
        }

        return $datos;
    }
    public function registrarProducto(ProductosDTO $productosDTO) {
        $sql = "INSERT INTO productos (NOMBRE, DESCRIPCION, PRECIO, ESPECIFICACIONES, TIPO_PRODUCTO)
                VALUES (?, ?, ?, ?, ?);";
        return $this->ejecutarConsulta($sql, $this->extraerDatosProducto($productosDTO));
    }
    public function obtenerProducto($id) {
        $sql = "SELECT * FROM productos WHERE ID = ?;";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error al obtener producto: " . $e->getMessage();
        }
    }
    public function listarProductos() {
        $sql = "SELECT * FROM productos;";
        return $this->ejecutarConsulta($sql, [], true);
    }
    public function actualizarProducto(ProductosDTO $productosDTO) {
        $sql = "UPDATE productos
                SET NOMBRE = ?, DESCRIPCION = ?, PRECIO = ?, ESPECIFICACIONES = ?, TIPO_PRODUCTO = ?
                WHERE ID = ?;";
        return $this->ejecutarConsulta($sql, $this->extraerDatosProducto($productosDTO, true));
    }
    public function eliminarProducto($id) {
        $sql = "DELETE FROM productos WHERE ID = ?;";
        return $this->ejecutarConsulta($sql, [$id]);
    }
}
