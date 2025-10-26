<?php
    require_once '../modelos/productosDAO.php';
    require_once '../modelos/productosDTO.php';
    require_once '../modelos/conexion.php';
    var_dump($_POST);
        if($_POST["accion"] == "registrar"){
        $productosDTO = new productosdto();
        $productosDTO->setNombre($_POST["nombre"]);
        $productosDTO->setDescripcion($_POST["descripcion"]);
        $productosDTO->setPrecio($_POST["precio"]);
        $productosDTO->setEspecificaciones($_POST["especificaciones"]);
        $productosDTO->setTipoProducto($_POST["Tipo_Producto"]);

        $productosDAO = new productosdao();
        $resultado = $productosDAO->registrar_producto($productosDTO);
        if($resultado === true){
            header("Location: ../vista/productos.php?mensaje=Producto registrado exitosamente");
        }else{
            header("Location: ../vista/productos.php?error=" . urlencode($resultado));
        }
    }
    elseif($_POST["accion"] == "editar"){
        $productosDTO = new productosdto();
        $productosDTO->setId($_POST["id"]);
        $productosDTO->setNombre($_POST["nombre"]);
        $productosDTO->setDescripcion($_POST["descripcion"]);
        $productosDTO->setPrecio($_POST["precio"]);
        $productosDTO->setEspecificaciones($_POST["especificaciones"]);
        $productosDTO->setTipoProducto($_POST["Tipo_Producto"]);

        $productosDAO = new productosdao();
        $resultado = $productosDAO->actualizar_producto($productosDTO);
        if($resultado === true){
            header("Location: ../vista/productos.php?mensaje=Producto actualizado exitosamente");
        }else{
            var_dump($resultado);
            var_dump();
            var_dump();
            //header("Location: ../vista/productos.php?error=" . urlencode($resultado));
        }
    } elseif($_POST["accion"] == "eliminar"){
        $id = $_POST["id"];
        $productosDAO = new productosdao();
        $resultado = $productosDAO->eliminar_producto($id);
        if($resultado === true){
                header("Location: ../vista/productos.php?mensaje=Producto eliminado exitosamente");
            }else{
                header("Location: ../vista/productos.php?error=" . urlencode($resultado));
            }
        }
    
