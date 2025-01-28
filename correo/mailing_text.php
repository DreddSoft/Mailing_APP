<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;


// Nos traemos estos documentos al completo
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP/bd.class.php');


$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Mailing_APP');
$dotenv->load();

// Si no esta el usuario registrado, redirigimos
if (!$_SESSION['usuario']) {

    header("Location: login.php");
}



//* Asignado: Fran
//* Asignado: Fran
// Formulario html con:
// 1. REMITENTE: Un campo input:email
// 2. DESTINATARIO: Un campo input:email
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error


// Variable vacio
$showExito = false;
$showError = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*Se almacena el correo y el remitente con el que se envia y reciben los correos, para asi porder enviar desde y hacia el correo que se 
            añaden en el fomrulario*/

    $destinatario = $_POST["destinatario"];
    $text_base = $_POST["mensaje"];
    $asunto = htmlspecialchars($_POST["asunto"]);

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings               
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV["SMTP_HOST"];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV["SMTP_USER"];                     //SMTP username
        $mail->Password   = $_ENV["SMTP_PASS"];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $_ENV["SMTP_PORT"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($_ENV["SMTP_USER"]);/*correo del remitente, recuperado del formulario */
        $mail->addAddress($destinatario);/* correo del destinatario, recuperado del formulario*/
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $text_base;
        $mail->CharSet = 'UTF-8';

        $mail->send();
        // echo 'El correo se ha enviado de forma exitosa, su destinatario debe haber recivido el correo';
        $showExito = true;
    } catch (Exception $e) {
        // die("Error: no se puedo enviar de forma correcta el correo. Mailer Error: {$mail->ErrorInfo}");
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
    <title>Mailing Text</title>
</head>

<body>
    <!-- Reutilización de código, incluimos el header en un archivo diferente -->
    <?php include_once('../header.php') ?>
    <main>

        <h2>Enviar correo</h2>
        <!-- Aquí va el formulario -->
        <form action="mailing_text.php" method="post">
            <input id="remitente" type="email" placeholder="Email remitente" name="remitente" readonly value="<?php echo $_ENV["SMTP_USER"]; ?>">
            <input id="destinatario" type="email" placeholder="Email destinatario" name="destinatario" required>
            <input id="asunto" type="text" placeholder="Asunto:" name="asunto" required>

            <div class="text-base" contenteditable="true" id="base"></div>
            <input type="text" name="mensaje" hidden="true" id="mensaje">
            <!-- igual que el texarea -->

            <div class="btns">
                <button type="submit" onclick="prepararMensaje();">Enviar</button>
                <button type="reset">Borrar</button>
            </div>

            <!-- Estructura de sintaxis alternativa, para el lanzamiento del error -->
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