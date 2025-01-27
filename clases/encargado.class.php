<?php

//* ADRIAN

// ✅ Clase que extiende de la clase empleado
// ✅ Atributo propio privado: rango, incrementoSalarial
// ✅ Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// ✅ GETTERS y SETTERS

// Incluimos la clase empleado
require_once 'empleado.class.php';

// Clase Encargado que extiende de Empleado
class Encargado extends Empleado {
    // Atributos propios de la clase
    private $rango;
    private $incrementoSalarial;

    // Constructor
    public function __construct($id, $nombre, $edad, $salario, $rango, $incrementoSalarial) {
        parent::__construct($id, $nombre, $edad, $salario + $incrementoSalarial);
        $this->rango = $rango;
    }

    // Metodo mostrarDatos que muestra todos los datos del empleado
    public function mostrarDatos() {
        return parent::mostrarDatos() . "Rango: $this->rango, Incremento salarial: $this->incrementoSalarial";
    }

    // GETTERS y SETTERS
    public function getRango() {
        return $this->rango;
    }

    public function setRango($rango) {
        $this->rango = $rango;
    }

    public function getIncrementoSalarial() {
        return $this->incrementoSalarial;
    }

    public function setIncrementoSalarial($incrementoSalarial) {
        $this->incrementoSalarial = $incrementoSalarial;
    }
}
?>