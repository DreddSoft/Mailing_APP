<?php

// Capturamos el nombre del archivo
$filename = basename($_SERVER['PHP_SELF']);

// Si es el index o el login, que están en la carpeta padre
if ($filename == "index.php" || $filename == "login.php") {
    // La ruta relativa es esta
    $ruta = "./";
} else {    // Cualquier otra
    // La ruta relativa es esta
    $ruta = "../";
}

?>

<footer>

<a href="https://github.com/DreddSoft/Mailing_APP" target="_blank">
    <img src="<?= $ruta ?>assets/logo_simple.svg" alt="Logo Simple">
    <span>Github</span>    
</a>
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