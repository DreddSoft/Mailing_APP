<?php
    //  use PHPMailer\PHPMailer\PHPMailer;
    //  use PHPMailer\PHPMailer\SMTP;
    //  use PHPMailer\PHPMailer\Exception;


    //* Asignado: Fran
// Formulario html con:
// 1. REMITENTE: Un campo input:email
// 2. DESTINATARIO: Un campo input:email
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error


// comprobacion y tratamientos de los datos, seguir con el try y con la sintaxis alternativa
session_start();    

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $remitente=$_REQUEST["remitente"];
    $destinatario=$_REQUEST["destinatario"];
    $tex_base=$_REQUEST["tex-base"];

    try{
        if(htmlspecialchars(isset($remitente))&&htmlspecialchars(isset($destinatario))){

        // //Load Composer's autoloader
        // require 'vendor/autoload.php';

        // //Create an instance; passing `true` enables exceptions
        // $mail = new PHPMailer(true);

        // try {
        //     //Server settings
        //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        //     $mail->isSMTP();                                            //Send using SMTP
        //     $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //     $mail->Username   = 'user@example.com';                     //SMTP username
        //     $mail->Password   = 'secret';                               //SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        //     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //     //Recipients
        //     $mail->setFrom('from@example.com', 'Mailer');
        //     $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        //     $mail->addAddress('ellen@example.com');               //Name is optional
        //     $mail->addReplyTo('info@example.com', 'Information');
        //     $mail->addCC('cc@example.com');
        //     $mail->addBCC('bcc@example.com');

        //     //Attachments
        //     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //     $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //     //Content
        //     $mail->isHTML(true);                                  //Set email format to HTML
        //     $mail->Subject = 'Here is the subject';
        //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        //     $mail->send();
        //     echo 'El correo se envió de forma exitosa, su remitente lo ha recivido';
        // } catch (Exception $e) {
        //     echo "Error: El correo no se envio, no se pudo transmitir el mensaje. Mailer Error: {$mail->ErrorInfo}";
        // }



        // }
    }
}
    catch(Exception $e){
       $menssage=true;/*Variable en verdadero, para hacer el lanzamiento del error en el fomrulario, con la sintaxis alternativa*/ 
      
    }
}




?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="new-php-logo.png" type="image/x-icon">
    <title>Mailing Text</title>
</head>

<body>
    <header>

        <img src="new-php-logo.png" alt="Logo de PHP">
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
         <form action="mailing_text.php"> 
            <input id="remitente"type="email" placeholder="email remitente" required><br>
            <input id="destinatario" type="email" placeholder="email destinatario" required><br>

            <div id="tex_base" contenteditable="true"></div> <!-- igual de un text area, pero mas bonito -->
            
            <div class="btns">
                <button type="submit">Enviar</button>
                <button type="reset">Borrar</button>
            </div>

            <!-- Estructura de sintaxis alternativa, para el lanzamiento del error -->

         </form> 

    </main>
    <footer>

        <a href="#">Github</a>
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