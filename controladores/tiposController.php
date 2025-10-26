<?php
namespace App\controladores;

use App\modelos\TiposDAO;
use App\modelos\TiposDTO;
use App\modelos\Conexion;
        if($_POST["accion"] == "registrar"){
        $tiposDTO = new TiposDTO();
        $tiposDTO->setNombre(htmlspecialchars(trim($_POST["nombre"]), ENT_QUOTES, 'UTF-8'));
        $tiposDTO->setDescripcion($_POST["descripcion"]);
        $tiposDTO->setEvento($_POST["evento"]);

        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->registrar_tipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo registrado exitosamente");
        }else{
            header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
        }
    }
    elseif($_POST["accion"] == "editar"){
        $tiposDTO = new TiposDTO();
        $tiposDTO->setId($_POST["id"]);
        $tiposDTO->setNombre(htmlspecialchars(trim($_POST["nombre"]), ENT_QUOTES, 'UTF-8'));
        $tiposDTO->setDescripcion(htmlspecialchars(trim($_POST["descripcion"]), ENT_QUOTES, 'UTF-8'));
        $tiposDTO->setEvento(htmlspecialchars(trim($_POST["evento"]), ENT_QUOTES, 'UTF-8'));

        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->actualizar_tipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo actualizado exitosamente");
        }else{
            header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
        }
    } elseif($_POST["accion"] == "eliminar"){
        $id = $_POST["id"];
        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->eliminar_tipo($id);
        if($resultado === true){
                header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo eliminado exitosamente");
            }else{
                header("Location: ../vista/tiposdeproductos.php?error=" . urlencode($resultado));
            }
        }
    
