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
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/clases/empleado.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/clases/empleadoPresencial.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/clases/empleadoRemoto.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/clases/encargado.class.php');


$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP');
$dotenv->load();

$bd = new bd();
$actualizado = false;
$mensaje = "";



//* CAPTURAR TODOS LOS DEPARTAMENTOS
try {

    $bd->conectar();

    $sql = "SELECT id, nombre, activo FROM departamentos";

    $departamentos = $bd->capturarDatos($sql);
} catch (Exception $e) {
    die("Error al cargar los departamentos de la base de datos: " . $e->getMessage());
} finally {
    $bd->cerrar();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturamos y depuramos variables
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $edad = intval(htmlspecialchars($_POST['edad']));
    $salario = floatval(htmlspecialchars($_POST['salario']));
    $tipo = intval(htmlspecialchars($_POST['tipo']));
    $oficina = null;

    // Capturamos el tipo
    if ($tipo == 1) {
        $oficina = trim(htmlspecialchars($_POST['oficina']));
    }

    $rango = intval(htmlspecialchars($_POST["rango"]));

    $idDpto = intval(htmlspecialchars($_POST["dpto"]));

    // LAS EVALUACIONES PARA CREAR EMPLEADOS
    if ($rango == 1) {  // Si es encargado

        try {
            $encargado = new Encargado($nombre, $edad, $salario, $idDpto, $rango, 0);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $actualizado = true;
        $mensaje = "Se ha creado un nuevo ENCARGADO: " . $encargado->getNombre();
    } else if ($tipo == 0) { // Empleado remoto
        try {
            $empleadoRemoto = new EmpleadoRemoto($nombre, $edad, $salario, $idDpto, 0);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $actualizado = true;
        $mensaje = "Se ha creado un nuevo EMPLEADOREMOTO: " . $empleadoRemoto->getNombre() . " | " . $tipo;
    } else {    // Empleado presencial

        try {
            $empleadoPresencial = new EmpleadoPresencial($nombre, $edad, $salario, $idDpto, $oficina);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $actualizado = true;
        $mensaje = "Se ha creado un nuevo EMPLEADO PRESENCIAL: " . $empleadoPresencial->getNombre();
        
    }
}







?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="shortcut icon" href="../assets/logo_simple.png" type="image/x-icon">
    <title>Editar Empleado</title>
</head>

<body>

    <!-- Reutilización de código, incluimos el header en un archivo diferente -->
    <?php include_once('../header.php') ?>
    <main>

        <div class="main_title">
            <h2>Crear Empleado</h2>
            <!-- Aquí va el formulario -->

            <p>Datos requeridos para dar de alta a un empleado</p>
        </div>
        <form action="crearEmpleado.php" method="post" class="form2">

            <input type="text" name="nombre" id="nombre" class="myInput2" placeholder="Nombre: " required>

            <input type="text" name="edad" id="edad" minlength="1" maxlength="3" pattern="[0-9]{2}" class="myInput2" placeholder="Edad: " required>

            <input type="text" name="salario" id="salario" class="myInput2" minlength="5" maxlength="7" pattern="[0-9]+" placeholder="Salario: " required>

            <div class="horizontal">
                <input type="radio" name="tipo" id="remoto" value="0" onclick="hideOficina();">
                <label for="remoto">Remoto</label>
                <input type="radio" name="tipo" id="presencial" value="1" onclick="showOficina();">
                <label for="presencial">Presencial</label>
            </div>

            <input type="text" name="oficina" id="oficina" class="myInput2 hidden" placeholder="Oficina:">

            <label for="">Tipo</label>
            <select name="rango" id="rango" class="myInput2">
                <option value="0" selected>Empleado</option>
                <option value="1">Encargado</option>
            </select>

            <label for="dpto">Departamento</label>
            <select name="dpto" id="dpto" class="myInput2">

                <?php foreach ($departamentos as $departamento): ?>
                    <option value="<?= $departamento["id"] ?>"><?= $departamento["nombre"] ?></option>

                <?php endforeach ?>

            </select>

            <div class="horizontal">
                <button type="submit">Crear</button>
                <button type="reset">Borrar</button>
            </div>

            <?php if ($actualizado) : ?>
                <p><?= $mensaje ?></p>
            <?php endif; ?>
        </form>
    </main>

    <!-- Reutilización de código, incluimos el footer como componenet -->
    <?php include_once('../footer.php'); ?>

    <script src="../script.js"></script>

</body>

</html>