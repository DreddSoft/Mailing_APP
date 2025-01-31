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
$empleado = [];
$departamentos = [];
$idEmpleado = null;
$emp = null;
$actualizado = false;
$mensaje = "";

// Capturar la variable pasada por parametro url
if (isset($_GET['id'])) {
    $idEmpleado = intval(trim(htmlspecialchars($_GET['id'])));

    try {

        $bd->conectar();

        $sql = "SELECT id, nombre, edad, salario, oficina, horasConexion, rango, idDpto FROM empleados WHERE id = $idEmpleado";

        // Capturamos el empleado
        $empleado = $bd->capturarDatos($sql);

        // Depuramos las variables de la consulta empleado
        $nombre = $empleado[0]['nombre'];
        $edad = $empleado[0]['edad'];
        $salario = $empleado[0]['salario'];
        $oficina = $empleado[0]['oficina'];
        $rango = $empleado[0]['rango'];
        $idDpto = $empleado[0]['idDpto'];
        $horasConexion = $empleado[0]['horasConexion'];

        $sql = "SELECT id, nombre, activo FROM departamentos";

        $departamentos = $bd->capturarDatos($sql);

        // Si el empleado esta vacio, no existe con ese nombre
        if (empty($empleado)) {
            $idEmpleado = null;
        } else {
            // Guardamos el idEmpleado en la variable de control $idEmpleado
            $idEmpleado = $empleado[0]["id"];

            //* Crear el objeto en base a los parámetros clave
            if ($rango == 1) {

                // Creamos un objeto encargado
                try {
                    echo "Entra en crear Encargado<br>";
                    $empleadoObj = new Encargado($nombre, $edad, $salario, $idDpto, $rango, 0, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else if (empty($oficina)) {
                // Creamos objeto Empleado Remoto
                try {
                    echo "Entra en crear Empleado Remoto<br>";
                    $empleadoRemoto = new EmpleadoRemoto($nombre, $edad, $salario, $idDpto, 0, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                // Creamos objeto Empleado Presencial
                try {
                    echo "Entra en crear Empleado Presencial<br>";
                    $empleadoPresencial = new EmpleadoPresencial($nombre, $edad, $salario, $idDpto, $oficina, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    } catch (Exception $e) {
        echo "Error en la captura de datos de la base de datos: " . $e->getMessage();
    } finally {
        $bd->cerrar();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
    // Depuramos la variable
    $nombreEmpleado = trim(htmlspecialchars($_GET['nombre']));

    // Conectamos con la base de datos
    try {

        $bd->conectar();

        $sql = "SELECT id, nombre, edad, salario, oficina, horasConexion, rango, idDpto FROM empleados WHERE nombre like '$nombreEmpleado'";

        // Capturamos el empleado
        $empleado = $bd->capturarDatos($sql);

        // Depuramos las variables de la consulta empleado
        $nombre = $empleado[0]['nombre'];
        $edad = $empleado[0]['edad'];
        $salario = $empleado[0]['salario'];
        $oficina = $empleado[0]['oficina'];
        $rango = $empleado[0]['rango'];
        $idDpto = $empleado[0]['idDpto'];
        $horasConexion = $empleado[0]['horasConexion'];

        $sql = "SELECT id, nombre, activo FROM departamentos";

        $departamentos = $bd->capturarDatos($sql);

        // Si el empleado esta vacio, no existe con ese nombre
        if (empty($empleado)) {
            $idEmpleado = null;
        } else {
            $idEmpleado = $empleado[0]["id"];

            //* Crear el objeto en base a los parámetros clave
            if ($rango == 1) {

                // Creamos un objeto encargado
                try {
                    $empleadoObj = new Encargado($nombre, $edad, $salario, $idDpto, $rango, 0, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else if (empty($oficina)) {
                // Creamos objeto Empleado Remoto
                try {
                    $empleadoRemoto = new EmpleadoRemoto($nombre, $edad, $salario, $idDpto, $horasConexion, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                // Creamos objeto Empleado Presencial
                try {
                    $empleadoPresencial = new EmpleadoPresencial($nombre, $edad, $salario, $idDpto, $oficina, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    } catch (Exception $e) {
        echo "Error en la captura de datos de la base de datos: " . $e->getMessage();
    } finally {
        $bd->cerrar();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {  //* Un else valdria, pero compruebo que se mande por POST

    // Si el envio es POST se entiende que el cliente ha hecho una modificacion del empleado
    // Capturamos los datos en variables por sanitizar
    $nombre = trim(htmlspecialchars($_POST["name"]));
    $edad = htmlspecialchars($_POST["edad"]);
    $salario = floatval(htmlspecialchars($_POST["salario"]));

    // Oficina
    $oficina = trim(htmlspecialchars($_POST["ofi"]));

    // Si es remoto, el valor de la bd es nulo
    if ($oficina == "Remoto") {
        $oficina = null;
    }

    // Capturamos y controlamos los valores de rango
    $rango = htmlspecialchars($_POST["rango"]);

    // Comprobamos que se haya realizado el envio del incremento
    if (isset($_POST["incre"])) {
        $incremento = floatval(htmlspecialchars($_POST["incre"]));
        $salario += $incremento;
    }

    // Capturamos el id del Departamento
    $dpto = htmlspecialchars($_POST["dpto"]);

    // Capturamos el id empleado
    $idEmpleado = htmlspecialchars($_POST["idEmp"]);

    try {
        // Conectamos con la base de datos
        $bd->conectar();

        // Actualizamos los datos en la base de datos
        $sql = "UPDATE empleados SET
        nombre = '$nombre',
        edad = $edad,
        salario = $salario,
        oficina = '$oficina',
        rango = $rango,
        idDpto = $dpto
        WHERE id = $idEmpleado";

        $actualizado = $bd->actualizarDatos($sql);


        // Capturamos los datos de nuevo
        $sql = "SELECT id, nombre, edad, salario, oficina, horasConexion, rango, idDpto FROM empleados WHERE id = $idEmpleado";

        // Capturamos el empleado
        $empleado = $bd->capturarDatos($sql);

        // Depuramos las variables de la consulta empleado
        $nombre = $empleado[0]['nombre'];
        $edad = $empleado[0]['edad'];
        $salario = $empleado[0]['salario'];
        $oficina = $empleado[0]['oficina'];
        $rango = $empleado[0]['rango'];
        $idDpto = $empleado[0]['idDpto'];
        $horasConexion = $empleado[0]['horasConexion'];

        $sql = "SELECT id, nombre, activo FROM departamentos";

        $departamentos = $bd->capturarDatos($sql);

        // Si el empleado esta vacio, no existe con ese nombre
        if (empty($empleado)) {
            $idEmpleado = null;
        } else {
            $idEmpleado = $empleado[0]["id"];

            //* Crear el objeto en base a los parámetros clave
            if ($rango == 1) {

                // Creamos un objeto encargado
                try {
                    $empleadoObj = new Encargado($nombre, $edad, $salario, $idDpto, $rango, 0, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else if (empty($oficina)) {
                // Creamos objeto Empleado Remoto
                try {
                    $empleadoRemoto = new EmpleadoRemoto($nombre, $edad, $salario, $idDpto, 0, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                // Creamos objeto Empleado Presencial
                try {
                    $empleadoPresencial = new EmpleadoPresencial($nombre, $edad, $salario, $idDpto, $oficina, $idEmpleado);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    } catch (Exception $e) {
        $mensaje = "Ha ocurrido un error: " . $e->getMessage();
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

        <h2>Editar Empleado</h2>
        <!-- Aquí va el formulario -->

        <?php if (!$idEmpleado) : ?>

            <form action="editarEmpleado.php" method="get" class="form2">
                <h3 class="blue">Datos Empleado</h3>

                <p class="red">Lo lamentamos, no hemos podido encontrar el empleado o no han sido proporcionados datos.</p>
                <label for="nombre">Introduce el nombre del empleado a editar: </label>
                <input type="text" name="nombre" id="nombre" class="myInput2">
                <div class="horizontal">
                    <button type="submit">Editar</button>
                    <button type="reset">Borrar</button>
                </div>
            </form>


        <?php else: ?>


            <form action="editarEmpleado.php" method="post" class="form3">

                <div class="horizontal">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="<?= $empleadoObj->getNombre(); ?>" class="myInput2">
                </div>

                <div class="horizontal">
                    <label for="edad">Edad</label>
                    <input type="number" name="edad" id="edad" value="<?= $empleadoObj->getEdad(); ?>" class="myInput2">
                </div>

                <div class="horizontal">
                    <label for="salario">Salario</label>
                    <input type="number" name="salario" id="salario" value="<?= $empleadoObj->getSalario(); ?>" class="myInput2">
                </div>

                <div class="horizontal">
                    <label for="ofi">Oficina</label>
                    <input type="text" name="ofi" id="ofi" value="<?= ($empleado[0]["oficina"]) ? $empleado[0]["oficina"] : "Remoto" ?>" class="myInput2">
                </div>

                <div class="horizontal">
                    <label for="rango">Rango</label>
                    <select name="rango" id="rango" class="myInput2">
                        <option value="1" <?php if ($empleadoObj->getRango()) echo " selected"; ?>>Encargado</option>
                        <option value="0" <?php if (!$empleadoObj->getRango()) echo " selected"; ?>>Empleado</option>
                    </select>
                </div>

                <?php if ($empleadoObj->getRango() == 1) : ?>
                    <div class="horizontal">
                        <label for="incre">Incremento</label>
                        <input type="number" name="incre" id="incre" class="myInput2">
                    </div>

                <?php endif; ?>

                <div class="horizontal">
                    <label for="dpto">Dpto:</label>
                    <select name="dpto" id="dpto" class="myInput2">
                        <?php foreach ($departamentos as $departamento) : ?>
                            <option value="<?= $departamento['id'] ?>" <?php if ($departamento['id'] == $empleadoObj->getIdDpto()) echo " selected"; ?>><?= $departamento['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="hidden" name="idEmp" id="idEmp" value="<?= $empleado[0]["id"] ?>">

                <div class="horizontal">
                    <button type="submit">Modificar Empleado</button>
                </div>

                <?php if ($actualizado) : ?>
                    <p class="red">Se han acutalizado los datos del empleado</p>
                    <p><?= $mensaje;  ?></p>

                <?php endif; ?>
                <p><?php echo $empleadoObj->mostrarDetalles(); ?></p>

                <?php if(get_class($empleadoObj) == "EmpleadoRemoto"): ?>

                    <p><?= $empleadoObj->trabajar(); ?></p>
                <?php endif; ?>

            </form>

        <?php endif; ?>

    </main>

    <!-- Reutilización de código, incluimos el footer como componenet -->
    <?php include_once('../footer.php'); ?>

    <script src="../script.js"></script>

</body>

</html>