<?php
namespace App\modelos;

class ProductosDTO {
        private $id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $especificaciones;
        private $tipo_producto;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
        public function setEspecificaciones($especificaciones){
            $this->especificaciones = $especificaciones;
        }
        public function getEspecificaciones(){
            return $this->especificaciones;
        }
        public function getTipoProducto(){
            return $this->tipo_producto;
        }
        public function setTipoProducto($tipo_producto){
            $this->tipo_producto = $tipo_producto;
        }
    }