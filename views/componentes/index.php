<h1 class="nombre-pagina">Componentes</h1>
<p class="descripcion-pagina">Administración de Componentes</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="componentes">
    <?php foreach ($componentes as $componente) { ?>
        <li>
            <p>Nombre: <span><?php echo $componente->nombre; ?></span> </p>
            <p>Cantidad: <span><?php echo $componente->cantidad; ?></span> </p>

            <div class="acciones">
                <a class="boton" href="/componentes/actualizar?id=<?php echo $componente->id; ?>">Actualizar</a>

                <form action="/componentes/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $componente->id; ?>">

                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>