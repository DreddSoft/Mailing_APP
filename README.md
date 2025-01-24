<img src="assets/logo_mailing_app.svg" /> 

# Proyecto Mailing_APP

**Versión 1:** Desarrollo de una aplicación de mailing con varias opciones de envío de email predefinidas.

## Objetivo
Esta aplicación ha sido desarrollada para cumplir con los requisitos de aprendizaje de la asignatura de Desarrollo Web en Entorno Servidor, del grado superior DAW.

---

## Tabla de Contenidos
1. [Características](#características)
2. [Instalación](#instalación)
3. [Uso](#uso)
4. [Requisitos Previos](#requisitos-previos)
5. [Documentación Técnica](#documentación-técnica)
6. [Contribución](#contribución)
7. [Licencia](#licencia)
8. [Autores](#autores)
9. [Agradecimientos](#agradecimientos)

---

## Características
- **Correo Simple:** Permite enviar un correo, donde la dirección del remitente viene dada por la cuenta de correo configurada en el servidor. Se puede elegir el remitente, el asunto y el cuerpo del email.
- **Correo con Copia (CC):** Similar a la acción anterior, pero permite añadir el campo CC para enviar una copia a otra dirección de correo electrónico.
- **Correo Seleccionado:** Permite enviar un correo, donde el remitente es seleccionado de una lista específica de direcciones configuradas en la base de datos. También se permite personalizar el asunto y el cuerpo del email.
- **Correo con Copia Seleccionado:** Similar a la funcionalidad anterior, pero añade la opción de seleccionar una dirección específica para añadir una copia (CC).

---

## Instalación
Para instalar el software en su equipo personal o servidor, siga los siguientes pasos:

1. **Requisitos:**
   - Descargar e instalar la aplicación [XAMPP](https://www.apachefriends.org/index.html).

2. **Configurar variables de entorno:**
   Crear un archivo `.env` en el directorio principal de la aplicación con las siguientes variables:
   ```env
   SMTP_HOST=host_del_servidor_mail
   SMTP_PORT=puerto_del_servidor_mail
   SMTP_USER=correo_remitente
   SMTP_PASS=contraseña_del_remitente
   DB_HOST=host_de_la_base_de_datos
   DB_USER=usuario_de_la_base_de_datos
   DB_PASS=contraseña_de_la_base_de_datos
   DB_NAME=nombre_de_la_base_de_datos
   ```

3. **Configurar la base de datos:**
   - Importar el archivo SQL proporcionado en su servidor MariaDB para configurar la base de datos correctamente.
   - Asegúrese de enlazar la base de datos con la aplicación a través del archivo `.env`.

4. **Ejecutar la aplicación:**
   - Coloque el proyecto en el directorio `htdocs` de XAMPP.
   - Inicie Apache y MariaDB desde el panel de control de XAMPP.
   - Acceda a la aplicación desde su navegador en `http://localhost/NombreProyecto`.

---

## Uso
La aplicación Mailing_APP permite gestionar envíos de correo electrónico mediante opciones predefinidas:

- Ideal para propósitos educativos o pequeños proyectos internos.
- Todas las funcionalidades están diseñadas para simplificar el proceso de mailing sin configuraciones complicadas.

---

## Requisitos Previos
- **XAMPP:** Descargue e instale XAMPP para crear un entorno local que incluya Apache, MariaDB y PHP.
- **Base de Datos:** Configurar una base de datos MariaDB enlazada a la aplicación.

---

## Documentación Técnica
La aplicación está desarrollada con las siguientes tecnologías:

- **Backend:**
  - PHP.
  - Librerías utilizadas:
    - [PHPMailer](https://github.com/PHPMailer/PHPMailer) para el manejo de correos.
    - [phpdotenv](https://github.com/vlucas/phpdotenv) para la gestión de variables de entorno.

- **Frontend:**
  - HTML.
  - JavaScript (Vanilla).
  - CSS con el preprocesador SASS.

- **Base de Datos:**
  - MariaDB SQL.

---

## Contribución
Contribuciones al proyecto están cerradas ya que cuenta con una licencia privada. Sin embargo, puede enviar comentarios o sugerencias contactando a los autores.

---

## Licencia
<p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/DreddSoft/Mailing_APP">Mailing_APP</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/DreddSoft">Andrés Bonilla</a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-SA 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" alt=""></a></p>

---

## Autores
- **Andrés Bonilla ([DreddSoft](https://github.com/DreddSoft)):** Desarrollador jefe e idea principal.
- **Adrián Jiménez ([ajimvil713](https://github.com/ajimvil713))**
- **David Villena ([davix1997](https://github.com/davix1997))**
- **Francisco D. Gutiérrez ([danielgr29](https://github.com/danielgr29))**
- **Iván López ([Ivan-Trevi](https://github.com/Ivan-Trevi))**

---

## Agradecimientos
Se agradece a todos los colaboradores y a la institución educativa por el apoyo en el desarrollo de este proyecto.





