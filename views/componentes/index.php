<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<div class="inventario">
    <a class="boton" href="/inventario/crear">Crear Nuevo Componente</a>
</div>

<h2 class="subtitulo">Lista de componentes</h2>

<input type="text" class="filtroInput" id="filtroInput" placeholder="Busca por nombre...">

<table class="componentes tabla">
    <thead>
        <th>Folio</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Estado</th>
        <th>Acciones</th>
    </thead>
    <tbody class="tabla-cuerpo">
        <?php foreach ($componentes as $componente) { ?>
            <tr>
                <td><?php echo $componente->id ?></td>
                <td><?php echo $componente->nombre ?></td>
                <td><?php echo $componente->categoria ?></td>
                <td><?php echo $componente->estado ?></td>
                <td>
                    <div class="acciones">
                        <a class="btn-yellow" href="/inventario/actualizar?id=<?php echo $componente->id; ?>">Actualizar</a>

                        <form class="eliminar" action="/inventario/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $componente->id; ?>">
                            <input type="submit" value="Borrar" class="btn-red">
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>