<?php

//* Asignado: Fran
// Formulario html con:
// 1. REMITENTE: Un campo input:email
// 2. DESTINATARIO: Un campo input:email
// 3. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 4. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 5. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 6. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error


// comprobacion y tratamientos de los datos, swguir con el try y con la sintaxis alternativa
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $remitente=$_REQUEST["remitente"];
    $destinatario=$_REQUEST["destinatario"];
    $tex_base=$_REQUEST["tex-base"];

    try{
        if(htmlspecialchars(isset($remitente))&&htmlspecialchars(isset($destinatario))){

        }
    }catch(Exception $e){
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

        <a href="https://github.com/DreddSoft/Mailing_APP">Github</a>
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