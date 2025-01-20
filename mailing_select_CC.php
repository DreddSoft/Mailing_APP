<?php

//* Asignado: Adrían
// Formulario html con:
// 1. REMITENTE: Un campo input:email que representa al remitente (el valor sera siempre el mismo)
// 2. DESTINATARIO: Un campo select con X opciones que vendrán dadas por la base de datos (yo os echare una mano en este código)
// 3. COPIA: un campo select con X opciones que vendrán dadas por la base de datos
// 4. CUERPO EMAIL: Un div con id="text-base" con un atributo específico para añadir texto: contenteditable="true"
// 5. El formulario tiene que tener 2 botones: 1 de envío y otro de reset
// 6. Cuando se pulse el botón enviar debe enviar un email usando PHP Mailer, tal y como hemos dado en clase
// 7. En caso de enviar el mail, tiene que mostrar un mensaje informativo, y si no lo envía, un mensaje de error

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="new-php-logo.png" type="image/x-icon">
    <title>Mailing Select CC</title>
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

        <h2>Enviar correo a destino seleccionado con copia</h2>
        <!-- Aquí va el formulario -->
        <form action="">
            <input type="email" name="remitente" id="remitente" placeholder="Email del remitente">
            <br><br>

            <input type="email" name="destinatario" id="destinatario" placeholder="Email del destinatario">
            <br><br>

            <input type="email" name="cc" id="cc" placeholder="Destinatario de copia">
            <br><br>

            <textarea name="cuerpo" id="cuerpo" placeholder="Contenido del mensaje"></textarea>
            <br><br>
            
            <div class="btns">
                <button type="submit">Enviar</button>
                <button type="reset">Borrar</button>
            </div>
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