<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Nos traemos estos documentos al completo
require_once 'vendor/autoload.php';
require_once 'bd.class.php';

$rutaAdrian = 'C:/xampp/htdocs/Mailing_APP';

$dotenv = Dotenv::createImmutable($rutaAdrian);
$dotenv->load();


// Crear objeto base de datos
$bd = new bd();

try {
    // Conectamos con la base de datos
    $bd->conectar();

    // Hacemos la consulta
    $sql = "SELECT email FROM usuarios";

    // Procesamos la consulta
    $datos = $bd->capturarDatos($sql);
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    // Cerramos la base de datos
    $bd->cerrar();
}

//* Asignado: Adrían
// Formulario html con:
// ✅ 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// ✅ 2. DESTINATARIO: Un campo select con X opciones que vendrán dadas por la base de datos (yo os echare una mano en este código)
// ✅ 3. COPIA: un campo select con X opciones que vendrán dadas por la base de datos
// ✅ (No hay un div es textarea) 4. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// ✅ 5. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// ✅ 6. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// ✅ 7. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error
// Faltan poner mas bonitos los mensajes de confirmación y de error.
// holaa
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $remitente = $_POST['remitente'];
    $destinatario = $_POST['destinatario'];
    $copia = $_POST['copia'];
    $cuerpoEmail = $_POST['cuerpo'];

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
        $mail->setFrom($remitente, 'Remitente');
        $mail->addAddress($destinatario);
        if (!empty($copia)) {
            $mail->addCC($copia);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Asunto del correo';
        $mail->Body = $cuerpoEmail;

        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. {$mail->ErrorInfo}";
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
    <title>Mailing Select CC</title>
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

        <h2>Enviar correo a destino seleccionado con copia</h2>
        <!-- Aquí va el formulario -->
        <form method="post">
            <input type="email" name="remitente" id="remitente" placeholder="Email del remitente" value="<?php echo "ajimvil713@gmail.com" ?>" readonly>

            <select name="destinatario" id="destinatario">
                <?php foreach($datos as $dato): ?>
                <option value="<?php echo $dato["email"] ?>"><?php echo $dato["email"] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="copia" id="copia">
                <?php foreach($datos as $dato): ?>
                <option value="<?php echo $dato["email"] ?>"><?php echo $dato["email"] ?></option>
                <?php endforeach; ?>
            </select>

            <textarea name="cuerpo" id="cuerpo" placeholder="Contenido del mensaje" require></textarea>
 

            <div class="btns">
                <button type="submit">Enviar</button>
                <button type="reset">Borrar</button>
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