<?php
session_start();


//* Asignado: Andrés
// Página principal con un mensaje informativo y un menu de enlaces para acceder a cada opción.

// Si no esta el usuario registrado, redirigimos
if (!$_SESSION['usuario']) {

    header("Location: login.php");

}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="new-php-logo.png" type="image/x-icon">
    <title>Index</title>
</head>

<body>
    <header>

        <img src="/assets/new-php-logo.png" alt="Logo de PHP">
        <nav>
            <a href="mailing_select.php">Correo Especial</a>
            <a href="mailing_select_CC.php">Correo Especial Copia</a>
            <a href="mailing_text.php">Correo</a>
            <a href="mailing_text_CC.php">Correo Copia</a>
        </nav>
        <h1>Aplicación de Mail</h1>

    </header>
    <main>

        <h2>Página Principal</h2>
         <div class="enlaces">
            <p>Aqui tiene una serie de enlaces, como en la cabecera para enviar emails</p>
            <a href="mailing_select.php">Correo Especial</a>
            <a href="mailing_select_CC.php">Correo Especial Copia</a>
            <a href="mailing_text.php">Correo</a>
            <a href="mailing_text_CC.php">Correo Copia</a>
         </div>

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

<!-- 
    Autor: @DreddSoft
    Proyecto: app_mailing
    Fecha: Enero de 2025
    Descripción: Página principal de la aplicación de mailing.
-->

</html>
