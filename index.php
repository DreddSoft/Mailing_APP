<?php
session_start();


//* Asignado: Andrés
// Página principal con un mensaje informativo y un menu de enlaces para acceder a cada opción.
// Porque no se cambia...asdasdsa

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
    <link rel="shortcut icon" href="assets/logo_simple.png" type="image/x-icon">
    <title>Index</title>
</head>

<body>

    <?php include_once('header.php'); ?>
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
    <?php include_once('footer.php'); ?>

    <script src="script.js"></script>

</body>

<!-- 
    Autor: @DreddSoft
    Proyecto: app_mailing
    Fecha: Enero de 2025
    Descripción: Página principal de la aplicación de mailing.
-->

</html>