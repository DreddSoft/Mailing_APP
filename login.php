<?php

//* Asignado: Andrés
// Realizar un formulario de acceso que pida nombre de usuario y contraseña
/*
- Usar control de errores.
- Usar Bases de datos para verificar los usuarios y las passwords
*/

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="new-php-logo.png" type="image/x-icon">
    <title>Mail_APP</title>
</head>

<body>
    <header>

        <img src="new-php-logo.png" alt="Logo de PHP">
        <nav style="display:none;">
            <a href="mailing_select.php">Correo Especial</a>
            <a href="mailing_select_CC.php">Correo Especial Copia</a>
            <a href="mailing_text.php">Correo</a>
            <a href="mailing_text_CC.php">Correo Copia</a>
        </nav>
        <h1 class="blue">Aplicación de Mail</h1>

    </header>
    <main>

        <h2 class="blue">Login</h2>
        <!-- Aquí va el formulario -->
         <form action="service.php" method="post">
            <input type="text" name="user" id="user" placeholder="Usuario" required autocomplete="off">
            <input type="password" name="pass" id="pass" placeholder="Contraseña" required autocomplete="off">

            <div class="btns">
                <button type="reset">Borrar</button>
                <button type="submit">Enviar</button>
            </div>
         </form>

    </main>
    <footer>

        <a href="#">Github</a>
        <h2 class="blue">DAW</h2>
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