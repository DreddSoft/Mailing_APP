<?php

class bd
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name_database = "mailapp";
    private $conn;

    //* Funcion para conectar la base de datos
    public function conectar()
    {

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name_database);

        if ($this->conn->connect_error) {
            die("Error al conectar la base de datos: " . $this->conn->connect_error);
        }
    }

    // Funcion para capturar datos que devuelve un array
    public function capturarDatos($sql)
    {

        // Preparamos la sentencia SQL
        $stmt = $this->conn->prepare($sql);

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
