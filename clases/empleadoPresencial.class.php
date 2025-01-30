<?php

//* IVAN LOPEZ

// - Clase que extiende de la clase empleado
// - Atributo propio privado: oficina.
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - GETTERS y SETTERS

// Incluimos la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');

require_once("empleado.class.php");

class EmpleadoPresencial extends Empleado {

    // Atributo privado para definir la oficina del empleado
    private $oficina;

    // Constructor
    public function __construct($nombre, $edad, $salario, $idDpto, $oficina) {
        parent::__construct($nombre, $edad, $salario, $idDpto);
        $this->oficina = $oficina;

        try {
            $bd = new bd();

            // Conectamos a la base de datos
            $bd->conectar();

            $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
            VALUES ('$nombre', $edad, $salario, '$oficina', NULL, 0, $idDpto)";

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

    // GETTER Y SETTER propios
    public function getOficina() {
        return $this->oficina;
    }

    public function setOficina($oficina) {
        $this->oficina = $oficina;
    }

    // Funcion de la clase empleado, plimorfismo porque añade mas detalles
    public function mostrarDetalles() {
        return parent::mostrarDetalles() . " , oficina: $this->oficina";
    }


}
