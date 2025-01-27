<?php

//* IVAN LOPEZ

// - Clase que extiende de la clase empleado
// - Atributo propio privado: oficina.
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - GETTERS y SETTERS

// Algo?

require_once("empleado.class.php");

class EmpleadoPresencial extends Empleado {

    // Atributo privado para definir la oficina del empleado
    private $oficina;

    // Constructor
    public function __construct($nombre, $edad, $salario, $oficina) {
        parent::__construct($nombre, $edad, $salario);
        $this->oficina = $oficina;
    }

    // GETTER Y SETTER propios
    public function getOficina() {
        return $this->oficina;
    }

    public function setOficina($oficina) {
        $this->oficina = $oficina;
    }

    // FUNCIONES PROPIAS
    public function mostrarDatos() {
        return parent::mostrarDatos() . " , oficina: $this->oficina";
    }


}
