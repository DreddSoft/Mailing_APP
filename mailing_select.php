<?php
// Usamos la función sesion start para mantener la sesión activa
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Nos traemos archivos php necesarios para el funcionamiento
require_once 'vendor/autoload.php';
require_once 'bd.class.php';

$dotenv = Dotenv::createImmutable('../Mailing_APP');
$dotenv->load();

//* Parte de base de datos
// Creamos objeto de la clase bd
$bd = new bd();

// Con try-catch controlamos la conexión a la base de datos
try {
    // conectamos la bd
    $bd->conectar();

    // Creamos la sentencia sql
    $sql = "SELECT email FROM usuarios";

    // Usamos el método de capturarDatos
    $datos = $bd->capturarDatos($sql);

    // Comprobamos que datos no este vacío
    if (empty($datos)) {
        echo "No estas obteniendo datos de la base de datos";
    }
} catch (Exception $e) {
    echo "Ha ocurrido una excepción con la base de datos: " . $e->getMessage();
} finally {
    // Cerramos la conexión con la bd
    $bd->cerrar();
}

// Si el método de envío es POST (esto es una comprobación por seguridad)
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $cuerpoEmail ="Hola";

    // Capturamos el destinataro, que es obligatorio ponerlo. 
    // Esto lo controlamos con un required en el formulario, o por que es un select
    $destinatario = $_POST["destinatario"];

    // Para capturar el asunto y el mensaje, que pueden ir vacíos, hay que envolverlos en un condicional
    if (isset($_POST["mensaje"])) {
        $cuerpoEmail = $_POST["mensaje"];
    } 

    if (isset($_POST['asunto'])) {
        $asunto = htmlspecialchars($_POST['asunto']);
    } else {
        $asunto = "";
    }
    $mail = new PHPMailer(true);
    //* Aquí empieza el bloque de envío de email, que debe ir envuelto en un try-catch
    try {

        global $cuerpoEmail;
        //* Configuración del servidor                                   
        $mail->isSMTP();                                           
        $mail->Host       = $_ENV['SMTP_HOST']; // Variable de entorno para acceder a nuestro host
        $mail->SMTPAuth   = true;                                   // Activa la autenticación SMTP
        $mail->Username   = $_ENV['SMTP_USER']; // Variable de entorno para nuestro usuario, nuestra cuenta de email
        $mail->Password   = $_ENV['SMTP_PASS']; // Variable de entorno para nuestra contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = $_ENV['SMTP_PORT']; // Variable de entorno para el puerto
        //! Ojo, esta línea del puerto, a veces, hay que comentarla por que da error
    
        //* Destinatarios y remitentes
        $mail->setFrom($_ENV['SMTP_USER']);
        $mail->addAddress($destinatario);  // Añade un destinatario, el nombre es opcional
    
        //* Contenido
        $mail->isHTML(true);    // Habilita el contenido tipo HTML
        $mail->Subject = $asunto;   // Asunto del email
        $mail->Body = $cuerpoEmail;  // Cuerpo del email
    
        $mail->send();  // Enviar el mensaje
        echo 'Mensaje enviado'; // Echo de comprobación
    } catch (Exception $e) {
        echo "Mensaje no enviado. Mailer Error: {$mail->ErrorInfo}";    // Echo de error
    }

}

//* Asignado: Iván
// Formulario html con:
// 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// 2. DESTINATARIO: Un campo select con X opciones que vendrán dadas por la base de datos (yo os echare una mano en este código)
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error
// 7. 

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="assets/new-php-logo.png" type="image/x-icon">
    <title>Mailing Select</title>
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

        <h2>Enviar Correo a destino seleccionado</h2>
        <!-- Aquí va el formulario -->
        <form action="mailing_select.php" method="POST">
        <input type="email" id="remitente" value="<?php echo $_ENV['SMTP_USER']; ?>" required placeholder="Remitente">
            <input type="email" id="destinatario" name="destinatario" required placeholder="Destinatario">
            <input type="text" id="asunto" name="asunto" placeholder="Asunto">
            <div class="text-base" contenteditable="true" placeholder="Mensaje" id="base">
            </div>
            <input type="text" hidden="true" name="mensaje" id="mensaje">
            <div class="btns">
                <button type="submit" onclick="prepararMensaje();">Enviar</button>
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

    <script>
        // Esta función se incluye porque el div.text-base no se captura con el envío del formulario, entonces lo que acepmos es asignarle su contenido a un input oculto que hay justo debajo que ese si lo coge el formulario
        function prepararMensaje() {
            // Capturamos el contenido del texto-base
            const mensaje = document.getElementById('base').innerHTML;
            // Asignamos ese contenido al input oculto que enviara el mensaje
            document.getElementById('mensaje').value = mensaje;
        }
    </script>

</body>

</html>