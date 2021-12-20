document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
    buscarComponente();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fechaApartados');
    fechaInput.addEventListener('input', function (e) {
        const fechaSeleccionada = e.target.value;
        window.location = `?fecha=${fechaSeleccionada}`;
    });
}

function buscarComponente() {
    alert('hola');
}