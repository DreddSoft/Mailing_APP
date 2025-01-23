<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;


require_once 'vendor/autoload.php';


$dotenv = Dotenv::createImmutable('C:/xampp/htdocs/Mailing_APP');
$dotenv->load();




//* Asignado: Fran
// Formulario html con:
// 1. REMITENTE: Un campo input:email
// 2. DESTINATARIO: Un campo input:email
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error




    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        
            /*Se almacena el correo y el remitente con el que se envia y reciben los correos, para asi porder enviar desde y hacia el correo que se 
            añaden en el fomrulario*/

            $remitente=$_POST["remitente"];
            $destinatario=$_POST["destinatario"];
            $cuerpoEmail=$_POST["text_base"];

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $_ENV["SMTP_HOST"];                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $_ENV["SMTP_USER"];                     //SMTP username
                $mail->Password   = $_ENV["SMTP_PASS"];                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = $_ENV["SMTP_PORT"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($remitente);/*correo del remitente, recuperado del formulario */
                $mail->addAddress($destinatario);/* correo del destinatario, recuperado del formulario*/     
              

                
                

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = $cuerpoEmail;

                $mail->send();
                echo 'El correo se ha enviado de forma exitosa, su destinatario debe haber recivido el correo';
            } catch (Exception $e) {
               die("Error: no se puedo enviar de forma correcta el correo. Mailer Error: {$mail->ErrorInfo}");
                
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
    <title>Mailing Text</title>
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

        <h2>Enviar correo</h2>
        <!-- Aquí va el formulario -->
        <form action="mailing_text.php" method="post">
            <input id="remitente" type="email" placeholder="email remitente"  name="remitente" readonly value="<?php echo $_ENV["SMTP_USER"] ?>">
            <input id="destinatario" type="email" placeholder="email destinatario" name="destinatario" required>
            <input type="text" name="asunto" id="asunto" placeholder="Asunto">
            <div class="text-base" contenteditable="true" id="base"></div> 
            <input type="hidden" name="mensaje" id="mensaje">
            <!-- igual que el texarea -->

            <div class="btns">
                <button type="submit" onclick="prepararMensaje();">Enviar</button>
                <button type="reset">Borrar</button>
            </div>

            <!-- Estructura de sintaxis alternativa, para el lanzamiento del error -->

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