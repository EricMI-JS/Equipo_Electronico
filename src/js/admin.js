let componenteId = 0;

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
    buscarComponente();
    enlaces();
}

function buscarPorFecha() {
    if (document.querySelector('#fechaApartados')) {
        const fechaInput = document.querySelector('#fechaApartados');
        fechaInput.addEventListener('input', function (e) {
            const fechaSeleccionada = e.target.value;
            window.location = `?fecha=${fechaSeleccionada}`;
        })
    }
    return;
}

function buscarComponente() {
    if (document.querySelector('#filtroInput')) {
        const filtroInput = document.querySelector('#filtroInput');

        filtroInput.addEventListener('keyup', function () {
            const filtro = filtroInput.value.toLowerCase();
            const componentes = document.querySelectorAll('.tabla-cuerpo tr')

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
}

function enlaces() {
    const enlaces = document.querySelectorAll('.abrir-modal');
    enlaces.forEach(enlace => {
        enlace.addEventListener('click', function (e) {
            e.preventDefault();
            componenteId = parseInt(e.target.dataset.id);
            mostrarModal();
        })
    })
}

function mostrarModal() {
    const cerrarModal = document.querySelector('#cerrar-modal');
    const contenedorModal = document.querySelector('#contenedor-modal');
    const modal = document.querySelector('.modal');
    const componentes = document.querySelectorAll(`[data-folio="${componenteId}"]`);

    contenedorModal.classList.add('show');

    componentes.forEach(componente => {
        modal.appendChild(componente);
        componente.style.display = "block";
    });

    // Cerramos el modal
    cerrarModal.addEventListener('click', function () {
        contenedorModal.classList.remove('show');
        componentes.forEach(componente => {
            modal.appendChild(componente);
            componente.style.display = "none";
        });
    })
}
