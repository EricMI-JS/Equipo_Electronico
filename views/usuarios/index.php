<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<h2 class="subtitulo">Listado de usuarios</h2>

<?php if (count($usuarios) === 0) {
    echo "<h4>No hay inventario</h4>";
} ?>

<table class=" tabla">
    <thead class="tabla-encabezado">
        <th>Clave</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Acciones</th>
    </thead>
    <?php
    $idUsuario = 0;
    foreach ($usuarios as $usuario) {
        if ($usuario->admin === '0') {
    ?>
            <tbody class="tabla-cuerpo">
                <tr>
                    <td><?php echo $usuario->clave_prof ?></td>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->apellido ?></td>
                    <td><?php echo $usuario->email ?></td>

                    <td class="acciones">
                        <form action="/usuarios/admin" method="POST">
                            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            <input type="submit" name="admin" class="btn-lightBlue" value="Hacer Admin">
                        </form>
                        <form action="/usuarios/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            <input type="submit" name="eliminar" class="btn-red" value="Eliminar">
                        </form>
                    </td>
                </tr>
            </tbody>
    <?php
        }
    } // Fin del foreach 
    ?>
</table>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>