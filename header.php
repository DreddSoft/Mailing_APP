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
<header>

    <div class="left-header">
        <a href="<?= $ruta ?>/index.php"><img src="<?= $ruta ?>assets/logo_mailing_app.svg" alt="Logo"></a>
        <nav>
            <div class="vertical">
                <a href="#" class="cabecera" id="1" onclick="mostrarSubmenu(this.id);">Correo</a>
                <ul id="submenu1" class="hidden">
                    <li></li>
                    <li><a href="<?= $ruta ?>correo/mailing_select.php">Seleccionado</a></li>
                    <li><a href="<?= $ruta ?>correo/mailing_select_CC.php">Seleccionado BCC</a></li>
                    <li><a href="<?= $ruta ?>correo/mailing_text.php">Normal</a></li>
                    <li><a href="<?= $ruta ?>correo/mailing_text_CC.php">Normal BCC</a></li>
                </ul>
            </div>

            <!-- Funcionalidad para empleado que debe ser -->
            <div class="vertical">
                <a href="#" class="cabecera" id="2" onclick="mostrarSubmenu(this.id);">Gestión Empleados</a>
                <ul id="submenu2" class="hidden">
                    <li></li>
                    <li><a href="<?= $ruta ?>gestion/listadoEmpleados.php">Listado</a></li>
                    <li><a href="#">Añadir</a></li>
                    <li><a href="<?= $ruta ?>gestion/editarEmpleado.php">Editar</a></li>
                </ul>
            </div>


            <div class="vertical">
                <a href="#" class="cabecera" id="3" onclick="mostrarSubmenu(this.id);">Departamentos</a>
                <ul id="submenu3" class="hidden">
                    <li></li>
                    <li><a href="#">Listado</a></li>
                    <li><a href="#">Crear</a></li>
                    <li><a href="#">Editar</a></li>
                </ul>
            </div>


            <!-- <?php //if ($usuario['super']) : 
                    ?>
                <div class="vertical">
                    <a href="#" class="cabecera" id="3" onclick="mostrarSubmenu(this.id);">Super</a>
                    <ul id="submenu3" class="hidden">
                        <li></li>
                        <li><a href="#">Lista de usuarios</a></li>
                        <li><a href="#">Añadir usuario</a></li>
                        <li><a href="#">Editar usuario</a></li>
                        <li><a href="#">Eliminar usuario</a></li>
                    </ul>
                </div>

            <?php //endif; 
            ?> -->

        </nav>
    </div>
    <div class="right-header">
        <h1>Aplicación de Mail</h1>
    </div>



</header>