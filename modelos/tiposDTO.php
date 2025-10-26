<?php
namespace App\modelos;

class TiposDTO {
        private $id;
        private $nombre;
        private $evento;
        private $descripcion;

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
        
        public function getEvento(){
            return $this->evento;
        }
        public function setEvento($evento){
            $this->evento = $evento;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
    }

