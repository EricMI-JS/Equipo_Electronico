<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) { ?>
    <div class="barra-componentes">
        <a class="boton" href="/admin">Ver Apartados</a>
        <a class="boton" href="/componentes">Ver Componentes</a>
        <a class="boton" href="/componentes/crear">Nuevo Componente</a>
    </div>
<?php } ?>