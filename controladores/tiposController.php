<?php
    require_once '../modelos/tiposDAO.php';
    require_once '../modelos/tiposDTO.php';
    require_once '../modelos/conexion.php';
    var_dump($_POST);
        if($_POST["accion"] == "registrar"){
        $tiposDTO = new tiposdto();
        $tiposDTO->setNombre($_POST["nombre"]);
        $tiposDTO->setDescripcion($_POST["descripcion"]);
        $tiposDTO->setEvento($_POST["evento"]);

        $tiposDAO = new tiposdao();
        $resultado = $tiposDAO->registrar_tipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo registrado exitosamente");
        }else{
            header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
        }
    }
    elseif($_POST["accion"] == "editar"){
        $tiposDTO = new tiposdto();
        $tiposDTO->setId($_POST["id"]);
        $tiposDTO->setNombre($_POST["nombre"]);
        $tiposDTO->setDescripcion($_POST["descripcion"]);
        $tiposDTO->setEvento($_POST["evento"]);

        $tiposDAO = new tiposdao();
        $resultado = $tiposDAO->actualizar_tipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo actualizado exitosamente");
        }else{
            header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
        }
    } elseif($_POST["accion"] == "eliminar"){
        $id = $_POST["id"];
        $tiposDAO = new tiposdao();
        $resultado = $tiposDAO->eliminar_tipo($id);
        if($resultado === true){
                header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo eliminado exitosamente");
            }else{
                header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
            }
        }
    
