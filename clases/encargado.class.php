<?php

//! EN ESTA CLASE ESTAMOS IMITANDO MANUALMENTE UN ORM
//* ADRIAN

// ✅ Clase que extiende de la clase empleado
// ✅ Atributo propio privado: rango, incrementoSalarial
// ✅ Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// ✅ GETTERS y SETTERS

// Incluimos la clase empleado y la base de datos
require_once 'empleado.class.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');


// Clase Encargado que extiende de Empleado
class Encargado extends Empleado
{
    // Atributos propios de la clase
    private $rango;
    private $incrementoSalarial;
    private $id;


    // Constructor de la clase
    public function __construct($nombre, $edad, $salario, $idDpto,  $rango, $incrementoSalarial) {
        parent::__construct($nombre, $edad, $salario + $incrementoSalarial, $idDpto);
        $this->rango = $rango;

        try {
            // Creamos un objeto de la clase bd
            $bd = new bd();

    // Constructor
    public function __construct($nombre, $edad, $salario, $idDpto,  $rango, $incrementoSalarial, $id = null)
    {
        parent::__construct($nombre, $edad, $salario + $incrementoSalarial, $idDpto);
        $this->rango = $rango;

        if ($id === null) {
            try {
                $bd = new bd();


                // Conectamos a la base de datos
                $bd->conectar();


            // Preparamos la inserccion
            $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
            VALUES ('$nombre', $edad, $salario, NULL, NULL, 1, $idDpto)";

            // Ejecutamos la inserccion
            $update = $bd->actualizarDatos($sql);

            // Si no se ha podido insertar lanzamos una excepcion
            if (!$update) {
                throw new Exception();
            }
        } catch (Exception $e) {
            // Lanzamos la excepcion si encontramos algo
            throw new Exception("No se ha podido crear el EMPLEADO TIPO ENCARGADO" . $e->getMessage());
        } finally {
            // Cerramos la base de datos
            $bd->cerrar();
        }
    }

    // Metodo que muestra todos los datos del empleado
    public function mostrarDatos() {
        return parent::mostrarDatos() . "Rango: $this->rango, Incremento salarial: $this->incrementoSalarial";

                $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
            VALUES ('$nombre', $edad, $salario, NULL, NULL, 1, $idDpto)";

                $update = $bd->actualizarDatos($sql);

                if (!$update) {
                    throw new Exception();
                }
            } catch (Exception $e) {
                throw new Exception("No se ha podido crear el EMPLEADO TIPO ENCARGADO" . $e->getMessage());
            } finally {
                $bd->cerrar();
            }
        } else {
            $this->id = $id;
        }
    }

    // Metodo mostrarDetalles que extiende y sobrescribe el metodo de la clase empleado
    public function mostrarDetalles()
    {
        return parent::mostrarDetalles() . ". Rango: $this->rango, Incremento salarial: $this->incrementoSalarial";

    }

    // GETTERS y SETTERS
    public function getRango()
    {
        return $this->rango;
    }

    public function setRango($rango)
    {
        $this->rango = $rango;
    }

    public function getIncrementoSalarial()
    {
        return $this->incrementoSalarial;
    }

    public function setIncrementoSalarial($incrementoSalarial)
    {
        $this->incrementoSalarial = $incrementoSalarial;
    }
}
