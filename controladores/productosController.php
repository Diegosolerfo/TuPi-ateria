<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\modelos\ProductosDAO;
use App\modelos\ProductosDTO;
use App\modelos\Conexion;
        if($_POST["accion"] == "registrar"){
        $productosDTO = new ProductosDTO();
        $productosDTO->setNombre(htmlspecialchars(trim($_POST["nombre"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setDescripcion(htmlspecialchars(trim($_POST["descripcion"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setPrecio(filter_var($_POST["precio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $productosDTO->setEspecificaciones(htmlspecialchars(trim($_POST["especificaciones"]), ENT_QUOTES, 'UTF-8'));
        $productosDTO->setTipoProducto(htmlspecialchars(trim($_POST["Tipo_Producto"]), ENT_QUOTES, 'UTF-8'));

        $productosDAO = new ProductosDAO();
        $resultado = $productosDAO->registrar_producto($productosDTO);
        if($resultado === true){
            header("Location: ../vista/productos.php?mensaje=Producto registrado exitosamente");
        }else{
            header("Location: ../vista/productos.php?error=" . urlencode($resultado));
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
        $resultado = $productosDAO->actualizar_producto($productosDTO);
        if($resultado === true){
            header("Location: ../vista/productos.php?mensaje=Producto actualizado exitosamente");
        }else{
            header("Location: ../vista/productos.php?error=" . urlencode($resultado));
        }
    } elseif($_POST["accion"] == "eliminar"){
        $id = $_POST["id"];
        $productosDAO = new ProductosDAO();
        $resultado = $productosDAO->eliminar_producto($id);
        if($resultado === true){
                header("Location: ../vista/productos.php?mensaje=Producto eliminado exitosamente");
            }else{
                header("Location: ../vista/productos.php?error=" . urlencode($resultado));
            }
        }
    
