<?php

//* Asignado: Andrés
// Realizar un formulario de acceso que pida nombre de usuario y contraseña
/*
- Usar control de errores.
- Usar Bases de datos para verificar los usuarios y las passwords
*/

$show = false;

// Capturamos el get
if (isset($_GET['mensaje'])) {

    $mensaje = htmlspecialchars($_GET['mensaje']);
    $show = true;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="assets/logo_simple.png" type="image/x-icon">
    <title>Mail_APP</title>
</head>

<body>
    <header>
        <div class="left-header">
            <a href="index.php"><img src="assets/logo_mailing_app.svg" alt="Logo"></a>
        </div>
        <div class="right-header">
            <h1>Aplicación de Mail</h1>
        </div>
    </header>
    <main>

        <h2 class="blue">Login</h2>
        <!-- Aquí va el formulario -->
        <form action="service.php" method="post" class="login">
            <input type="text" name="user" id="user" placeholder="Usuario" required autocomplete="on">
            <input type="password" name="pass" id="pass" placeholder="Contraseña" required autocomplete="on">

            <div class="btns">
                <button type="reset">Borrar</button>
                <button type="submit">Enviar</button>
            </div>

            <?php if ($show):
                global $mensaje; ?>
                <div class="mensaje">
                    <p><?= $mensaje ?></p>
                </div>

            <?php endif; ?>
        </form>

    </main>
    <footer>

        <a href="https://github.com/DreddSoft/Mailing_APP" target="_blank">Github</a>
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
<!-- 
    Autor: @DreddSoft
    Proyecto: app_mailing
    Fecha: Enero de 2025
    Descripción: Página de inicio y login
-->

</html>