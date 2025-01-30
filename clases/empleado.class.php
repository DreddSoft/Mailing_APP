<?php

//* DAVID VILENA

//! - Clase con atributos privados: id, nombre, edad, salario (esto tenemos que comentarlo luego)
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - GETTERS y SETTERS
    class Empleado {
        //atributos de la clase empleado
        private $id;
        private $nombre;
        private $edad;
        private $salario;
        private $idDpto;
        //constructor de empleado
        public function __construct($nombre, $edad, $salario, $idDpto){

            $this->nombre = $nombre;
            $this->edad = $edad;
            $this->salario = $salario;
            $this->idDpto = $idDpto;
        }
        //funcion que muestra todos los datos de un empleado
        public function mostrarDetalles(){

            return $this->nombre . " " . $this->edad . " " . $this->salario;
        }
        //getters y setters para todos los atributos de empleado
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
        public function getEdad(){
            return $this->edad;
        }
        public function setEdad($edad){
            $this->edad = $edad;
        }
        public function getSalario(){
            return $this->salario;
        }
        public function setSalario($salario){
            $this->salario = $salario;
        }
    }

?>