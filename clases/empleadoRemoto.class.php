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

    public function __construct($horasConexion,$edad,$id,$salario){
        parent::__construct($edad,$id,$salario);
        $this->horasConexion = $horasConexion;

    }

    public function __getHoraConexion()
    {
        return $this->horasConexion;
    }

    public function __setHoraConexion($horasConect)
    {
        $this->horasConexion = $horasConect;
    }

    public function mostrarDatos()
    {
        return parent::mostrarDatos();
    }

    public function trabajado()
    {
        return "Tus horas de trabajo como esclavo son: " . $this->__getHoraConexion();
    }
}
