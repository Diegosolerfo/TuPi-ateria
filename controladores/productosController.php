<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\modelos\ProductosDAO;
use App\modelos\ProductosDTO;
use App\modelos\Conexion;
use App\modelos\DaoException;

    $url = "Location: ../vista/productos.php?error=";
        if(!isset($_POST["accion"])) {
    header($url . "Acción no especificada");
    exit();
}

if($_POST["accion"] == "registrar"){
        $productosDTO = new ProductosDTO();
        $productosDTO->setNombre($_POST["nombre"] ?? '');
        $productosDTO->setDescripcion($_POST["descripcion"] ?? '');
        $productosDTO->setPrecio($_POST["precio"] ?? 0);
        $productosDTO->setEspecificaciones($_POST["especificaciones"] ?? '');
        $productosDTO->setTipoProducto($_POST["Tipo_Producto"] ?? '');

        $productosDAO = new ProductosDAO();
        try {
            $resultado = $productosDAO->registrarProducto($productosDTO);
            if ($resultado === true) {
                header("Location: ../vista/productos.php?mensaje=Producto registrado exitosamente");
            }
        } catch (DaoException $e) {
            header($url . urlencode($e->getMessage()));
            exit();
        }
    }
    elseif($_POST["accion"] == "editar"){
        $productosDTO = new ProductosDTO();
        $productosDTO->setId($_POST["id"]);
        $productosDTO->setNombre(htmlspecialchars(trim($_POST["nombre"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setDescripcion(htmlspecialchars(trim($_POST["descripcion"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setPrecio(filter_var($_POST["precio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $productosDTO->setEspecificaciones(htmlspecialchars(trim($_POST["especificaciones"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setTipoProducto(htmlspecialchars(trim($_POST["Tipo_Producto"]), ENT_QUOTES, 'UTF-8'));

        $productosDAO = new ProductosDAO();
        try {
            $resultado = $productosDAO->actualizarProducto($productosDTO);
            if ($resultado === true) {
                header("Location: ../vista/productos.php?mensaje=Producto actualizado exitosamente");
            }
        } catch (DaoException $e) {
            header($url . urlencode($e->getMessage()));
            exit();
        }
    } elseif($_POST["accion"] == "eliminar"){
        $id = $_POST["id"];
        $productosDAO = new ProductosDAO();
        try {
            $resultado = $productosDAO->eliminarProducto($id);
            if ($resultado === true) {
                header("Location: ../vista/productos.php?mensaje=Producto eliminado exitosamente");
            }
        } catch (DaoException $e) {
            header($url . urlencode($e->getMessage()));
            exit();
        }
    }

