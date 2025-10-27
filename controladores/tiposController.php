<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\modelos\TiposDAO;
use App\modelos\TiposDTO;
use App\modelos\Conexion;
    $url = "Location: ../vista/tiposdeproductos.php?error=";
        if(!isset($_POST["accion"])) {
    header($url . "Acción no especificada");
    exit();
}

if($_POST["accion"] == "registrar"){
        $tiposDTO = new TiposDTO();
        $tiposDTO->setNombre($_POST["nombre"] ?? '');
        $tiposDTO->setDescripcion($_POST["descripcion"] ?? '');
        $tiposDTO->setEvento($_POST["evento"] ?? '');

        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->registrarTipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo registrado exitosamente");
        }else{
            header($url . urlencode($resultado));
        }
    }
    elseif($_POST["accion"] == "editar"){
        $tiposDTO = new TiposDTO();
        $tiposDTO->setId($_POST["id"] ?? 0);
        $tiposDTO->setNombre($_POST["nombre"] ?? '');
        $tiposDTO->setDescripcion($_POST["descripcion"] ?? '');
        $tiposDTO->setEvento($_POST["evento"] ?? '');

        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->actualizarTipo($tiposDTO);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo actualizado exitosamente");
        }else{
            header($url . urlencode($resultado));
        }
    } elseif($_POST["accion"] == "eliminar"){
        if (!isset($_POST["id"])) {
            header($url . "ID no especificado");
            exit();
        }
        $id = $_POST["id"];
        $tiposDAO = new TiposDAO();
        $resultado = $tiposDAO->eliminarTipo($id);
        if($resultado === true){
            header("Location: ../vista/tiposdeproductos.php?mensaje=Tipo eliminado exitosamente");
        }else{
            header($url . urlencode($resultado));
        }
    }

