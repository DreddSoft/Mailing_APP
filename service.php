<?php

// cookie de sesión 30 minutos
session_set_cookie_params(1800);
session_start();

require_once 'bd.class.php';

$bd = new bd();


//* Asignado: Andrés
// Servicio de backEnd para en control de acceso
/*
- Usar control de errores.
- Usar Bases de datos para verificar los usuarios y las passwords
*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Capturar variables
    $user = htmlspecialchars($_POST['user']);
    $pass = htmlspecialchars($_POST['pass']);


    try {

        $bd->conectar();

        //* Aqui tendremos que hacer las comprobaciones de bd
        // Consulta SQL
        $sql = "SELECT id, email, pass FROM usuarios";

        // Este es un metodo propio que devuelve un array con los datos
        $dataUsuarios = $bd->capturarDatos($sql);

        // Comprobacion de usuario y contrasenia
        if (strtolower($user) === strtolower($dataUsuarios['email']) && $pass === $dataUsuarios['pass']) {

            // crear la sesion de usuario
            $_SESSION['usuario'] = $user;

            // Redirigimos al index
            header("Location: index.php");
            exit();
        } else {
            // Redirigimos con mensaje
            $mensaje = "Nombre de usuario o contraseña incorrectos";
            header("location: login.php?mensaje=$mensaje");
            exit();
        }
    } catch (Exception $e) {
        die("Ocurrio una excepcion en la base de datos: " . $e->getMessage());
    }



} else {
    $mensaje = "El metodo de acceso no es correcto.";
    header("Location: login.php?mensaje=$mensaje");
}
