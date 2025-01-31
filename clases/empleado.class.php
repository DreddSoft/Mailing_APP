<?php

//* DAVID VILENA

require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');

//! - Clase con atributos privados: id, nombre, edad, salario (esto tenemos que comentarlo luego)
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - GETTERS y SETTERS
    class Empleado {
        //atributos de la clase empleado
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

            try {
                $bd = new bd();
    
                // Conectamos a la base de datos
                $bd->conectar();
    
                $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
                VALUES ('$nombre', $edad, $salario, NULL, NULL, 0, $idDpto)";
    
                $update = $bd->actualizarDatos($sql);


    
                if (!$update) {
                    throw new Exception();
                }
    
            } catch (Exception $e) {
                throw new Exception("No se ha podido crear el EMPLEADO TIPO ENCARGADO");
            } finally {
                $bd->cerrar();
            }

        }
        //funcion que muestra todos los datos de un empleado
        public function mostrarDetalles(){

            return $this->nombre . " " . $this->edad . " " . $this->salario;
        }
        //getters y setters para todos los atributos de empleado
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;

            try {
                $bd = new bd();
    
                // Conectamos a la base de datos
                $bd->conectar();
    
                $sql = "UPDATE empleados
                SET nombre = '$nombre'
                WHERE id = ";
    
                $update = $bd->actualizarDatos($sql);
    
                if (!$update) {
                    throw new Exception();
                }
    
            } catch (Exception $e) {
                throw new Exception("No se ha podido crear el EMPLEADO TIPO ENCARGADO");
            } finally {
                $bd->cerrar();
            }
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
        public function getIdDpto() {
            return $this->idDpto;
        }

        public function setIdDpto($idDpto) {
            $this->idDpto = $idDpto;
        }
    }

?>