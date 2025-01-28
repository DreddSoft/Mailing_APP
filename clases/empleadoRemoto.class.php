<?php

//* FRANCISCO D. GUTIERREZ

// - Clase que extiende de la clase empleado
// - Atributo propio privado: horasConexion
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - Metodo trabajar que muestre las horas de conexion (ver en enunciado Noemi)
// - GETTERS y SETTERS


// se usa requiere.once("empleado.php") a



require_once("empleado.class.php");
class EmpleadoRemoto extends Empleado{

    private $horasConexion;

    public function __construct($nombre, $edad, $salario, $horasConexion){
        parent::__construct($nombre, $edad, $salario);
        $this->horasConexion = $horasConexion;

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
