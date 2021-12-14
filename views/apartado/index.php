<h1 class="nombre-pagina">Crear Nueva Apartado</h1>
<p class="descripcion-pagina">Elige tus componentes y coloca tus datos</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Componentes</button>
        <button type="button" data-paso="2">Información Apartado</button>
        <button type="button" data-paso="3">Resumen y cantidades</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Componentes</h2>
        <p class="text-center">Elige tus componentes a continuación</p>


        <input type="text" class="filtroInput" id="filtroInput" placeholder="Busca por nombre...">


        <div id="componentes" class="listado-componentes"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Apartado</h2>
        <p class="text-center">Coloca tus datos y fecha de tu apartado</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input id="fecha" type="date" min="<?php echo date('Y-m-d'); ?>" />
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input id="hora" type="time" />
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">

        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>

        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php
$script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>