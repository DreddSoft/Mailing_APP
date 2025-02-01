<?php

//* Asignado: Adrían

// Formulario html con:
// ✅ 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// ✅ 2. DESTINATARIO: Un campo select con X opciones que vendrán dadas por la base de datos (yo os echare una mano en este código)
// ✅ 3. COPIA: un campo select con X opciones que vendrán dadas por la base de datos
// ✅ (No hay un div es textarea) 4. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// ✅ 5. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// ✅ 6. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// ✅ 7. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error

// Iniciamos la sesion
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;
 
// Nos traemos estos documentos al completo
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');

// Cargamos las variables de entorno
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP');
$dotenv->load();

// Redirigmimos al login si no hay usuario en la sesion
if (!$_SESSION['usuario']) {
    header("Location: Mailing_APP/login.php");
}

// Variable vacio
$showExito = false;
$showError = false;

// Crear objeto base de datos
$bd = new bd();

try {
    // Conectamos con la base de datos
    $bd->conectar();

    // Preparamos la consulta
    $sql = "SELECT email
    FROM usuarios";

    // Ejecutamos la consulta
    $datos = $bd->capturarDatos($sql);
} catch (Exception $e) {
    // Lanzamos excepcion si encontramos algo
    echo $e->getMessage();
} finally {
    // Cerramos la base de datos
    $bd->cerrar();
}

// Si hemos recibido los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Recogemos los datos del formulario y los limpiamos
    $destinatario = htmlspecialchars($_POST['destinatario']);
    $copia = htmlspecialchars($_POST['copia']);

    // Comprobamos si el cuerpo del email está vacío
    if ($_POST['cuerpo']) {
        $cuerpoEmail = htmlspecialchars($_POST['cuerpo']);
    } else {
        $cuerpoEmail = "Texto vacío";
    }

    // Comprobamos si el asunto del email está vacío
    if ($_POST['asunto']) {
        $asunto = htmlspecialchars($_POST['asunto']);
    } else {
        $asunto = "Envio de mail sin asunto realizado por la aplicación más cañera: Mailing_APP";
    }

    // Creamos un objeto de la clase PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Remitente y destinatarios
        $mail->setFrom($_ENV['SMTP_USER']);
        $mail->addAddress($destinatario);
        if (!empty($copia)) {
            $mail->addCC($copia);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpoEmail;
        $mail->CharSet = 'UTF-8';

        $mail->send();
        // echo 'El mensaje ha sido enviado';
        $showExito = true;
    } catch (Exception $e) {
        // echo "El mensaje no pudo ser enviado. {$mail->ErrorInfo}";
        $showError = true;
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
    <title>Mailing Select CC</title>
</head>
<body>
    <!-- Reutilización de código, incluimos el header en un archivo diferente -->
    <?php include_once('../header.php') ?>
    <main>
        <h2>Enviar correo a destino seleccionado con copia</h2>
        <!-- Aquí va el formulario -->
        <form method="post">
            <input type="email" name="remitente" id="remitente" placeholder="Email del remitente" value="<?php echo $_ENV['SMTP_USER'] ?>" readonly class="myInput3">

            <select name="destinatario" id="destinatario" class="myInput3">
                <?php foreach ($datos as $dato): ?>
                    <option value="<?php echo $dato["email"] ?>"><?php echo $dato["email"] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="copia" id="copia" class="myInput3">
                <?php foreach ($datos as $dato): ?>
                    <option value="<?php echo $dato["email"] ?>"><?php echo $dato["email"] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="asunto" id="asunto" placeholder="Asunto" class="myInput3">

            <textarea name="cuerpo" id="cuerpo" placeholder="Contenido del mensaje" require></textarea>


            <div class="btns">
                <button type="submit">Enviar</button>
                <button type="reset">Borrar</button>
            </div>

            <div class="show">
                <?php if ($showExito) : ?>
                    <p class="exito">El mensaje ha sido enviado correctamente</p>
                <?php elseif ($showError): ?>
                    <p class="error">El mensaje no pudo ser enviado: <?= $mail->ErrorInfo; ?></p>
                <?php endif; ?>
            </div>
        </form>
    </main>

    <!-- Reutilización de código, incluimos el footer como componenet -->
    <?php include_once('../footer.php'); ?>

    <script src="../script.js"></script>
</body>
</html>