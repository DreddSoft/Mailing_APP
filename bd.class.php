<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;  // Esto es para abrir el archivo .env con la información delicada




$rutaAndres= "C:/xampp/htdocs/mailing_app";

$dotenv = Dotenv::createImmutable($rutaAndres);
$dotenv->load();

class bd
{

    // Variables privadas
    private $host;
    private $user;
    private $pass;
    private $name_database;
    private $conn;

    // Constructor
    public function __construct()
    {
        // Asignar las variables de entorno a las propiedades para asi proteger mas la conexión
        // También que sea más fácil personalizarlas dependiendo
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->name_database = $_ENV['DB_NAME'];
    }

    //* Funcion para conectar la base de datos
    public function conectar()
    {

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name_database);

        if ($this->conn->connect_error) {
            die("Error al conectar la base de datos: " . $this->conn->connect_error);
        }
    }

    //* Funcion para capturar datos que devuelve un array
    public function capturarDatos($sql)
    {

        $query = mysqli_query($this->conn, $sql);

        // Variable para devolver el arrray
        $data = [];

        // Bucle while para recorrer todas las capturas y incrustarlas en el array
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }



    public function cerrar()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
