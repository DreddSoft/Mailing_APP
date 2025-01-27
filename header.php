<header>

    <div class="left-header">
        <a href="index.php"><img src="assets/logo_mailing_app.svg" alt="Logo"></a>
        <nav>
            <div class="vertical">
                <a href="#" class="cabecera" id="1" onclick="mostrarSubmenu(this.id);">Mailing</a>
                <ul id="submenu1" class="hidden">
                    <li></li>
                    <li><a href="mailing_select.php">Correo Especial</a></li>
                    <li><a href="mailing_select_CC.php">Correo Especial Copia</a></li>
                    <li><a href="mailing_text.php">Correo</a></li>
                    <li><a href="mailing_text_CC.php">Correo Copia</a></li>
                </ul>
            </div>

            <!-- Funcionalidad para empleado que debe ser -->
            <div class="vertical">
                <a href="#" class="cabecera" id="2" onclick="mostrarSubmenu(this.id);">Administración</a>
                <ul id="submenu2" class="hidden">
                    <li></li>
                    <li><a href="./administracion/verEmpleados.php">Ver Empleados</a></li>
                    <li><a href="#">Crear Empleado</a></li>
                    <li><a href="#">Eliminar Empleado</a></li>
                </ul>
            </div>


            <div class="vertical">
                <a href="#" class="cabecera" id="3" onclick="mostrarSubmenu(this.id);">Super</a>
                <ul id="submenu3" class="hidden">
                    <li></li>
                    <li><a href="#">Ver Usuarios</a></li>
                    <li><a href="#">Crear Usuarios</a></li>
                    <li><a href="#">Eliminar Usuarios</a></li>
                </ul>
            </div>



        </nav>
    </div>
    <div class="right-header">
        <h1>Aplicación de Mail</h1>
    </div>



</header>