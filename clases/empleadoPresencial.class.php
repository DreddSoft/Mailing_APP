<?php

//* IVAN LOPEZ

// - Clase que extiende de la clase empleado
// - Atributo propio privado: oficina.
// - Metodo mostrarDatos(): el to string que muestre todos los datos del empleado
// - GETTERS y SETTERS

// Incluye nuestra base de datos que vamos a implementar
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php'); // Incluye el archivo bd.class.php que contiene la clase bd para la conexión y manejo de la base de datos.

require_once("empleado.class.php"); // Incluye el archivo empleado.class.php que contiene la definicion de la clase empleado.

class EmpleadoPresencial extends Empleado
{

    // Atributo privado para definir la oficina del empleado
    private $oficina;
    private $id;

    // Constructor
    public function __construct($nombre, $edad, $salario, $idDpto, $oficina, $id = null)
    {
        //Llama al constructor de la clase padre (empleado) para inicializar los atributos heredados.
        parent::__construct($nombre, $edad, $salario, $idDpto);
        $this->oficina = $oficina;

        if ($id === null) { //Si no se pasa un id, crea un nuevo empleado en la base de datos.
            try {
                $bd = new bd(); // Crea una instancia de la clase bd.

                // Conectamos a la base de datos
                $bd->conectar();
                // Sentencia SQL para insertar un nuevo empleado en la base de datos.
                $sql = "INSERT INTO empleados (nombre, edad, salario, oficina, horasConexion, rango, idDpto)
            VALUES ('$nombre', $edad, $salario, '$oficina', NULL, 0, $idDpto)";

                $update = $bd->actualizarDatos($sql); // Ejecuta la sentencia SQL-

                if (!$update) {
                    // Si la inserción no se realiza correctamente, lanza una excepción
                    throw new Exception();
                }
            } catch (Exception $e) {
                throw new Exception("No se ha podido crear el EMPLEADO TIPO ENCARGADO");
            } finally {
                // Cierra la conexión a la base de datos
                $bd->cerrar();
            }
        } else {
            // Si se pasa un id, lo asigna al atributo id.
            $this->id = $id;
        }
    }

    // GETTER Y SETTER

    // GETTER para el atributo oficina
    public function getOficina()
    {
        return $this->oficina;
    }
    // SETTER para el atributo oficina
    public function setOficina($oficina)
    {
        $this->oficina = $oficina;
    }

    // Método que muestra los detalles del empleado, aplica polimorfismo añadiendo el atributo oficina.
    public function mostrarDetalles()
    {
        return parent::mostrarDetalles() . " , oficina: $this->oficina";
    }
}
