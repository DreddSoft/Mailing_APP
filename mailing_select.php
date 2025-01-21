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

$dotenv = Dotenv::createImmutable("../Mailing_APP");
$dotenv->load();


//* Asignado: Iván
// Formulario html con:
// 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// 2. DESTINATARIO: Un campo select con X opciones que vendrán dadas por la base de datos (yo os echare una mano en este código)
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error

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

// Capturar las variables y hacer echo de prueba
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    echo $_POST['remitente'];
    echo $_POST['destinatario'];
    echo $_POST['mensaje'];

}


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
        <form action="mailing_select.php" method="post">
            <!-- Le damos valor con la variable de entorno -->
            <input type="email" name="remitente" id="remitente" value="<?php echo $_ENV['SMTP_USER'] ?>" readonly>
            <select name="destinatario" id="destinatario">
                <?php foreach ($datos as $dato): ?>
                    <option value="<?php echo $dato['email'] ?>"><?php echo $dato['email'] ?></option>

                <?php endforeach; ?>
            </select>
            <div class="text-base" contenteditable="true" id="base"></div>
            <input type="hidden" name="mensaje" id="mensaje">
            <div class="btns">
                <button type="reset">Borrar</button>
                <button type="submit" onclick="prepararMensaje();">Enviar</button>
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
        function prepararMensaje() {
            // Capturamos el contenido del texto-base
            const mensaje = document.getElementById('base').innerHTML;
            // Asignamos ese contenido al input oculto que enviara el mensaje
            document.getElementById('mensaje').value = mensaje;
        }
    </script>

</body>

</html>