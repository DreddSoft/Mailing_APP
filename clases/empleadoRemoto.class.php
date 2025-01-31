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
class EmpleadoRemoto extends Empleado
{

    private $horasConexion;
    private $id;

    public function __construct($nombre, $edad, $salario, $idDpto, $horasConexion, $id = null)
    {
        parent::__construct($nombre, $edad, $salario, $idDpto);
        $this->horasConexion = $horasConexion;

        if ($id === null) {
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
        } else {
            $this->id = $id;
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

    // funcion heredada de la clase empleado que cumple el polimorfismo
    public function mostrarDetalles()
    {
        return parent::mostrarDetalles() . ", horas de conexión: " . $this->horasConexion;
    }

    public function trabajar()
    {
        return "Tus horas de trabajo como esclavo son: " . $this->getHoraConexion();
    }
}
