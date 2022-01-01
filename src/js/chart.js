// document.addEventListener('DOMContentLoaded', function () {
//     iniciarApp();
// });

// function iniciarApp() {
//     // consultarAPI(); // Consulta la API en el backend de PHP
//     mostrarChart();
// }

// async function consultarAPI() {
//     try {
//         const url = 'http://localhost:3000/api/apartados';
//         const resultado = await fetch(url);
//         const componentes = await resultado.json();
//         contarRepetidos(componentes);

//     } catch (error) {
//         console.log(error);
//     }
// }

// function contarRepetidos(componentes) {

//     contados = componentes.map(componente => componente.apartado_componenteId);

//     mostrarChart(contados.reduce((a, d) => (a[d] ? a[d] += 1 : a[d] = 1, a), {}));
// }


const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Cables', 'Laptop', 'Cañon', 'Access Point', 'Router', 'Surface'],
        datasets: [{
            label: '27# Componentes en total',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});