<?php

//* FRANCISCO D. GUTIERREZ

// - Clase que extiende de la clase empleado
// - Atributo propio privado: horasConexion
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - Metodo trabajar que muestre las horas de conexion (ver en enunciado Noemi)
// - GETTERS y SETTERS

// Incluimos la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');



require_once("empleado.class.php");
class EmpleadoRemoto extends Empleado{

    private $horasConexion;

    public function __construct($nombre, $edad, $salario, $idDpto, $horasConexion){
        parent::__construct($nombre, $edad, $salario, $idDpto);
        $this->horasConexion = $horasConexion;

        try {
            $bd = new bd();

            // Conectamos a la base de datos
            $bd->conectar();

            $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
            VALUES ('$nombre', $edad, $salario, NULL, $horasConexion, 0, $idDpto)";

            $update = $bd->actualizarDatos($sql);

            if (!$update) {
                throw new Exception();
            }

        } catch (Exception $e) {
            throw new Exception("No se ha podido crear el EMPLEADO REMOTO" . $e->getMessage());
        } finally {
            $bd->cerrar();
        }

    }

    public function getHoraConexion()
    {
        return $this->horasConexion;
    }

    public function setHoraConexion($horasConect)
    {
        $this->horasConexion = $horasConect;
    }

    public function mostrarDatos()
    {
        return parent::mostrarDatos();
    }

    public function trabajado()
    {
        return "Tus horas de trabajo como esclavo son: " . $this->getHoraConexion();
    }
}
