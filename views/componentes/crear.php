<h1 class="nombre-pagina">Nuevo Componente</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo componente</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/componentes/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Guardar Componente">
</form>