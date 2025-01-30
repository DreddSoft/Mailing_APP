
// funcion para mostrar submenu
function mostrarSubmenu(id) {

    let submenu = document.getElementById(`submenu${id}`);

    // Si esta oculto
    if (submenu.classList.contains("hidden")) {

        // Mostramos
        submenu.classList.remove("hidden");

    } else {    // Si no esta oculto

        // Ocultamos
        submenu.classList.add("hidden");

    }

}

// Esta función se incluye porque el div.text-base no se captura con el envío del formulario, entonces lo que acepmos es asignarle su contenido a un input oculto que hay justo debajo que ese si lo coge el formulario
function prepararMensaje() {
    // Capturamos el contenido del texto-base
    const mensaje = document.getElementById('base').innerHTML;
    // Asignamos ese contenido al input oculto que enviara el mensaje
    document.getElementById('mensaje').value = mensaje;
}

function editarEmpleado(id) {

    window.open(`editarEmpleado.php?id=${id}`, "_blank");
    
}

function showOficina() {
    const iptOficina = document.getElementById("oficina");


        iptOficina.classList.remove("hidden");

}

function hideOficina() {

    const iptOficina = document.getElementById("oficina");


    iptOficina.classList.add("hidden");
    
}