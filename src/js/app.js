let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const apartado = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    componentes: []
}

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la API en el backend de PHP

    idCliente();
    nombreCliente(); // Añade el nombre del cliente al objeto de apartado
    seleccionarFecha(); // Añade la fecha de la apartado en el objeto
    seleccionarHora(); // Añade la hora de la apartado en el objeto

    mostrarResumen(); // Muestra el resumen de la apartado

    buscarComponente();
}

function mostrarSeccion() {

    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la sección con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {

    // Agrega y cambia la variable de paso según el tab seleccionado
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();

            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {

        if (paso <= pasoInicial) return;
        paso--;

        botonesPaginador();
    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {

        if (paso >= pasoFinal) return;
        paso++;

        botonesPaginador();
    })
}

async function consultarAPI() {
    try {
        const url = 'http://localhost:3000/api/componentes';
        const resultado = await fetch(url);
        const componentes = await resultado.json();

        filtrarDisponibles(componentes);
    } catch (error) {
        console.log(error);
    }
}

// Elimina las categorias repetidas
function filtrarDisponibles(componentes) {
    const disponibles = componentes.filter(componente => componente.estado === '0');
    mostrarComponentes(disponibles);
}

function mostrarComponentes(componentes) {
    componentes.forEach(componente => {
        const { id, categoria, nombre } = componente;

        const nombreComponente = document.createElement('P');
        nombreComponente.classList.add('nombre-componente');
        nombreComponente.textContent = nombre;

        const categoriaComponente = document.createElement('P');
        categoriaComponente.classList.add('categoria-componente');
        categoriaComponente.textContent = categoria;

        const componenteDiv = document.createElement('DIV');
        componenteDiv.classList.add('componente');
        componenteDiv.dataset.idComponente = id;
        componenteDiv.onclick = function () {
            seleccionarComponente(componente);
        }

        componenteDiv.appendChild(nombreComponente);
        componenteDiv.appendChild(categoriaComponente);

        document.querySelector('#componentes').appendChild(componenteDiv);
    });

    buscarComponente();
}

function seleccionarComponente(componente) {
    const { id } = componente;
    const { componentes } = apartado;

    // Identificar el elemento al que se le da click
    const divComponente = document.querySelector(`[data-id-componente="${id}"]`);

    // Comprobar si un componente ya fue agregado 
    if (componentes.some(agregado => agregado.id === id)) {
        // Eliminarlo
        apartado.componentes = componentes.filter(agregado => agregado.id !== id);
        divComponente.classList.remove('seleccionado');
    } else {
        // Agregarlo
        apartado.componentes = [...componentes, componente];
        divComponente.classList.add('seleccionado');
    }
    // console.log(apartado);
}

function idCliente() {
    apartado.id = document.querySelector('#id').value;
}

function nombreCliente() {
    apartado.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {

        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            apartado.fecha = e.target.value;
        }

    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {


        const horaApartado = e.target.value;
        const hora = horaApartado.split(":")[0];
        if (hora < 7 || hora > 20) {
            e.target.value = '';
            mostrarAlerta('Hora No Válida', 'error', '.formulario');
        } else {
            apartado.hora = e.target.value;

            // console.log(apartado);
        }
    })
}

function seleccionarCantidad() {
    // const inputCantidad = document.querySelectorAll('.contenedor-componente input');
    // const { componentes } = apartado;

    // for (let i = 0; i < inputCantidad.length; i++) {
    //     componentes[i].cantidad = inputCantidad[i].value;
    // }
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    // Previene que se generen más de 1 alerta
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    // Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        // Eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    // Limpiar el Contenido de Resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(apartado).includes('') || apartado.componentes.length === 0) {
        mostrarAlerta('Faltan datos de Componentes, Fecha u Hora', 'error', '.contenido-resumen', false);

        return;
    }

    // Formatear el div de resumen
    const { nombre, fecha, hora, componentes } = apartado;

    // Heading para Componentes en Resumen
    const headingComponentes = document.createElement('H3');
    headingComponentes.textContent = 'Resumen de Componentes';
    resumen.appendChild(headingComponentes);

    // Iterando y mostrando los componentes
    componentes.forEach(componente => {
        const { id, cantidad, nombre } = componente;

        const contenedorComponente = document.createElement('DIV');
        contenedorComponente.classList.add('contenedor-componente');

        const textoComponente = document.createElement('P');
        textoComponente.textContent = nombre;

        const idComponente = document.createElement('P');
        idComponente.textContent = `Folio: ${id}`;

        // const cantidadComponente = document.createElement('INPUT');
        // cantidadComponente.setAttribute('type', 'number');
        // cantidadComponente.setAttribute('min', '1');
        // cantidadComponente.setAttribute('max', `${cantidad}`);
        // cantidadComponente.setAttribute('value', '1');

        contenedorComponente.appendChild(textoComponente);
        contenedorComponente.appendChild(idComponente);
        // contenedorComponente.appendChild(cantidadComponente);

        resumen.appendChild(contenedorComponente);
    });

    // Heading para Apartado en Resumen
    const headingApartado = document.createElement('H3');
    headingApartado.textContent = 'Resumen de Apartado';
    resumen.appendChild(headingApartado);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);

    const fechaApartado = document.createElement('P');
    fechaApartado.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaApartado = document.createElement('P');
    horaApartado.innerHTML = `<span>Hora a recoger:</span> ${hora} Horas`;

    // Boton para Crear una apartado
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Apartado';
    botonReservar.onclick = reservarApartado;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaApartado);
    resumen.appendChild(horaApartado);

    resumen.appendChild(botonReservar);
}

async function reservarApartado() {

    const { nombre, fecha, hora, componentes, id } = apartado;

    const idComponentes = componentes.map(componente => componente.id);

    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('apartado_usuarioId', id);
    datos.append('componentes', idComponentes);

    // console.log([...datos]);

    // Petición hacia la api
    const url = 'http://localhost:3000/api/apartados';

    try {
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Apartado Correcto',
                text: 'Apartaste tus componentes correctamente',
                button: 'Ok'
            }).then(() => {
                window.location.reload();
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Ocurrió un error',
            text: 'Veremos que sucede intenta más tarde...',
            button: 'Ok'
        }).then(() => {
            window.location.reload();
        })
    }
}

function buscarComponente() {

    const filtroInput = document.querySelector('#filtroInput');

    filtroInput.addEventListener('keyup', function () {
        const filtro = filtroInput.value.toLowerCase();
        const componentes = document.querySelectorAll('.componente')

        componentes.forEach(componente => {
            let texto = componente.textContent;
            if (texto.toLowerCase().includes(filtro.toLowerCase())) {
                componente.style.display = '';
            } else {
                componente.style.display = 'none';
            }
        });
    })

}