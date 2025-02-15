<?php

// Sessión
session_start();


// Si no esta el usuario registrado, redirigimos
if (!$_SESSION['usuario']) {

    header("Location: ../login.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Nos traemos estos documentos al completo
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP');
$dotenv->load();

$bd = new bd();
$empleados = [];

try {

    $bd->conectar();

    $sql = "SELECT E.id, E.nombre, E.edad, E.salario, E.oficina, E.rango, D.nombre AS nombreDpto
    FROM empleados AS E 
    LEFT JOIN departamentos AS D ON D.id = E.idDpto
    ORDER BY E.id";

    $empleados = $bd->capturarDatos($sql);

    // Comprobamos que datos no este vacío
    if (empty($empleados)) {
        echo "No estas obteniendo datos de la base de datos";
    }
} catch (Exception $e) {
    echo "Error en la captura de datos de la base de datos: " . $e->getMessage();
} finally {
    $bd->cerrar();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="shortcut icon" href="../assets/logo_simple.png" type="image/x-icon">
    <title>Listado Empleados</title>
</head>

<body>

    <!-- Reutilización de código, incluimos el header en un archivo diferente -->
    <?php include_once('../header.php') ?>
    <main>

        <h2>Listado de empleados de la compañia</h2>
        <!-- Aquí va el formulario -->
        <table>
            <tr>
                <th class="hidden">idEmpleado</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Salario</th>
                <th>Oficina</th>
                <th>Encargado</th>
                <th>Departamento</th>
            </tr>

            <?php foreach ($empleados as $empleado) : ?>
                <tr id="<?= $empleado['id']; ?>" ondblclick="editarEmpleado(this.id)">
                    <td><?= $empleado['nombre']; ?></td>
                    <td><?= $empleado['edad']; ?></td>
                    <td><?= $empleado['salario']; ?> &euro;</td>
                    <td>
                        <?php if ($empleado['oficina']) : ?>
                            <?= $empleado['oficina']; ?>
                        <?php else : ?>
                            REMOTO
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($empleado['rango']): ?>
                            SI
                        <?php else : ?>
                            NO
                        <?php endif; ?>
                    </td>
                    <td><?= $empleado['nombreDpto']; ?></td>
                </tr>

            <?php endforeach; ?>
            

        </table>

    </main>

    <!-- Reutilización de código, incluimos el footer como componenet -->
    <?php include_once('../footer.php'); ?>

    <script src="../script.js"></script>

</body>

</html>