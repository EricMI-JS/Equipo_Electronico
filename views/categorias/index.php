<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<a class="boton" href="/categoria/crear">Crear nueva Categoría</a>

<input type="text" class="filtroInput" id="filtroInput" placeholder="Busca por nombre...">

<table class="componentes tabla">
    <thead>
        <th>Id</th>
        <th>Nombre</th>
    </thead>
    <tbody class="tabla-cuerpo">
        <?php foreach ($categorias as $categoria) {

        ?>
            <tr>
                <td><?php echo $categoria->id ?></td>
                <td><?php echo $categoria->nombre ?></td>
                <td>
                    <div class="acciones">
                        <a class="btn-yellow" href="/categoria/actualizar?id=<?php echo $categoria->id; ?>">Actualizar</a>

                        <form class="eliminar" action="/categoria/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                            <input type="submit" value="Borrar" class="btn-red">
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$script = "<script src='build/js/admin.js'></script>"
?>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>