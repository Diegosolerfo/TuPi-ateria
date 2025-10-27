<?php
namespace App\modelos;

use PDO;
use PDOException;
use App\modelos\Conexion;
use App\modelos\TiposDTO;
use App\modelos\DaoException;

class TiposDAO {
    private $conexion;
    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }
        private function sanitizarDatos(TiposDTO $tipo) {
            return [
                'nombre' => htmlspecialchars(trim($tipo->getNombre()), ENT_QUOTES, 'UTF-8'),
                'descripcion' => htmlspecialchars(trim($tipo->getDescripcion()), ENT_QUOTES, 'UTF-8'),
                'evento' => htmlspecialchars(trim($tipo->getEvento()), ENT_QUOTES, 'UTF-8')
            ];
        }

        private function validarDatos(array $datos) {
            if (empty($datos['nombre'])) {
                throw new \InvalidArgumentException("El nombre es requerido");
            }
            if (strlen($datos['nombre']) > 100) {
                throw new \InvalidArgumentException("El nombre no puede exceder los 100 caracteres");
            }
            return true;
        }

        public function registrarTipo(TiposDTO $tipo) {
            try {
                $datos = $this->sanitizarDatos($tipo);
                $this->validarDatos($datos);

                $sql = "INSERT INTO tipos (NOMBRE, DESCRIPCION, EVENTO) VALUES (?, ?, ?)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $datos['nombre']);
                $stmt->bindParam(2, $datos['descripcion']);
                $stmt->bindParam(3, $datos['evento']);
                
                if (!$stmt->execute()) {
                    throw new \PDOException("Error al ejecutar la consulta");
                }
                return true;
            } catch (PDOException $e) {
                // Lanzamos una excepción dedicada para que la capa superior la maneje
                throw new DaoException("Error al registrar tipo de producto: " . $e->getMessage(), 0, $e);
            }
        }
        public function obtenerTipo($id) {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException("ID inválido");
            }

            $sql = "SELECT * FROM tipos WHERE ID = ?";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$resultado) {
                    throw new \RuntimeException("Tipo no encontrado"); //NOSONAR
                }
                return $resultado;
            } catch (PDOException $e) {
                throw new DaoException("Error al obtener tipo: " . $e->getMessage(), 0, $e);
            }
        }
        public function listarTipos() {
            $sql = "SELECT * FROM tipos ORDER BY NOMBRE ASC";
            try {
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!$resultados) {
                    return [];
                }
                return $resultados;
            } catch (PDOException $e) {
                throw new DaoException("Error al listar tipos de productos: " . $e->getMessage(), 0, $e);
            }
        }
        public function actualizarTipo(TiposDTO $tipo) {
            try {
                if (!$this->obtenerTipo($tipo->getId())) {
                    throw new \RuntimeException("Tipo no encontrado para actualizar"); //NOSONAR
                }

                $datos = $this->sanitizarDatos($tipo);
                $this->validarDatos($datos);

                $sql = "UPDATE tipos SET NOMBRE = ?, DESCRIPCION = ?, EVENTO = ? WHERE ID = ?";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $datos['nombre']);
                $stmt->bindParam(2, $datos['descripcion']);
                $stmt->bindParam(3, $datos['evento']);
                $stmt->bindParam(4, $tipo->getId(), PDO::PARAM_INT);

                if (!$stmt->execute()) {
                    throw new \PDOException("Error al ejecutar la actualización");
                }
                return true;
            } catch (PDOException $e) {
                throw new DaoException("Error al actualizar tipo: " . $e->getMessage(), 0, $e);
            }
        }
        public function eliminarTipo($id) {
            try {
                if (!is_numeric($id) || $id <= 0) {
                    throw new \InvalidArgumentException("ID inválido");
                }

                if (!$this->obtenerTipo($id)) {
                    throw new \RuntimeException("Tipo no encontrado para eliminar"); //NOSONAR
                }

                $sql = "DELETE FROM tipos WHERE ID = ?";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                
                if (!$stmt->execute()) {
                    throw new \PDOException("Error al ejecutar la eliminación");
                }
                return true;
            } catch (PDOException $e) {
                throw new DaoException("Error al eliminar tipo: " . $e->getMessage(), 0, $e);
            }
        }
    }
 
