<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Nos traemos estos documentos al completo
require_once '../vendor/autoload.php';
require_once '../bd.class.php';

$dotenv = Dotenv::createImmutable("../../Mailing_APP");
$dotenv->load();

// Si no esta el usuario registrado, redirigimos
if (!$_SESSION['usuario']) {

    header("Location: login.php");
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="assets/logo_simple.png" type="image/x-icon">
    <title>Mailing Select CC</title>
</head>

<body>

    <!-- Reutilización de código, incluimos el header en un archivo diferente -->
    <?php include_once('header.php') ?>
    <main>

        <h2>Listado de empleados de la compañia</h2>
        <!-- Aquí va el formulario -->
         <table>
            <tr>
                <th>idEmpleado</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Salario</th>
                <th>Oficina</th>
                <th>Encargado</th>
            </tr>
    
         </table>

    </main>

    <!-- Reutilización de código, incluimos el footer como componenet -->
    <?php include_once('footer.php'); ?>

    <script src="script.js"></script>

</body>

</html>