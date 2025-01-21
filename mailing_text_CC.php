<?php
session_start();
// Modificamos el tiempo del servidor, porque a veces corta el programa
set_time_limit(3600);


//* Asignado: David
// Formulario html con:
// 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// 2. DESTINATARIO: input:email
// 3. COPIA: input:email
// 4. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 5. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 6. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 7. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable("../Mailing_APP");
$dotenv->load();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensaje = "No empty";

    $remitente = $_POST["remitente"];
    $destino = $_POST["destino"];
    $copia = htmlspecialchars($_POST["copia"]);
    if (isset($_POST["mensaje"])) {
        $mensaje = $_POST["mensaje"];
    } 


    $email = new PHPMailer(true);

    try {

        //configuracion de phpmailer
        $email->isSMTP();
        $email->SMTPAuth = true;
        $email->SMTPSecure = 'ssl';
        $email->Port = "465";

        //configuracion del servidor SMTP
        $email->Host = $_ENV["SMTP_HOST"];
        $email->Username = $_ENV['SMTP_USER'];
        $email->Password = $_ENV["SMTP_PASS"];
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //confiiguracion del mail
        $email->setFrom($remitente, "Remitente");
        $email->addAddress($destino);
        $email->addCC($copia);
        $email->Subject = 'Asunto del correo';
        $email->isHTML(true);
        $email->Body = $mensaje;

        //funcion que manda el correo
        $email->Send();
        echo 'El mensaje se ha enviado correctamente';
    } catch (Exception $e) {
        echo 'El mensaje no se ha podido enviar correctamente, por este motivo: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="assets/new-php-logo.png" type="image/x-icon">
    <title>Mailing Text CC</title>
</head>

<body>
    <header>

        <a href="index.php"><img src="assets/new-php-logo.png" alt="Logo de PHP"></a>
        <nav>
            <a href="mailing_select.php">Correo Especial</a>
            <a href="mailing_select_CC.php">Correo Especial Copia</a>
            <a href="mailing_text.php">Correo</a>
            <a href="mailing_text_CC.php">Correo Copia</a>
        </nav>
        <h1>Aplicación de Mail</h1>

    </header>
    <main>

        <h2>Enviar correo con copia</h2>
        <!-- Aquí va el formulario -->
        <form action="mailing_text_CC.php" method="POST">
            <input type="email" id="remitente" required placeholder="Remitente" name="remitente">
            <input type="email" id="destino" required placeholder="Destinatario" name="destino">
            <input type="email" id="copia" required placeholder="Copia" name="copia">
            <div id="text-base" contenteditable="true" placeholder="Mensaje" id="mensaje" name="mensaje">
            </div>
            <div class="btns">
                <button type="submit">Enviar</button>
                <button type="reset">Reset</button>
            </div>
        </form>
    </main>
    <footer>

        <a href="https://github.com/DreddSoft/Mailing_APP" target="_blank">Github</a>
        <h2>DAW</h2>
        <div class="equipo">
            <h3>Equipo</h3>
            <span>Andrés</span>
            <span>Adrián</span>
            <span>David</span>
            <span>Fran</span>
            <span>Iván</span>
        </div>

    </footer>

</body>

</html>