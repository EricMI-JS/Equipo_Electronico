<?php include_once __DIR__ . '/header-admin.php'; ?>

<h2 class="subtitulo">Listado de usuarios</h2>
<?php if (count($usuarios) === 0) {
    echo "<h4>No hay inventario</h4>";
} ?>

<table class=" tabla">
    <thead class="tabla-encabezado">
        <th>No. Control</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Acciones</th>
    </thead>
    <?php
    $idUsuario = 0;
    foreach ($usuarios as $usuario) {

    ?>
        <tbody class="tabla-cuerpo">
            <tr>
                <td><?php echo $usuario->nocontrol ?></td>
                <td><?php echo $usuario->nombre ?></td>
                <td><?php echo $usuario->apellido ?></td>
                <td><?php echo $usuario->email ?></td>

                <td>
                    <form class="acciones" action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                        <input type="submit" name="aceptar" class="btn-lightBlue" value="Hacer Admin">
                        <input type="submit" name="rechazar" class="btn-red" value="Eliminar">
                    </form>
                </td>
            </tr>
        </tbody>
    <?php
    } // Fin del foreach 
    ?>
</table>



<?php include_once __DIR__ . '/footer-admin.php'; ?>