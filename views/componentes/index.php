<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<a class="boton" href="/inventario/crear">Crear Componente</a>
<a class="boton" href="/categoria/crear">Crear Categoría</a>

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
        <?php foreach ($componentes as $componente) {

        ?>
            <tr>
                <td><?php echo $componente->id ?></td>
                <td><?php echo $componente->nombre ?></td>
                <td><?php echo $componente->categoria ?></td>
                <td class="<?php if ($componente->estado === '0') {
                                echo "aprobado";
                            } elseif ($componente->estado === '1') {
                                echo "pendiente";
                            } ?>"><?php if ($componente->estado === '0') {
                                        echo "Disponible";
                                    } elseif ($componente->estado === '1') {
                                        echo "En uso";
                                    } ?></td>
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

<?php
$script = "<script src='build/js/admin.js'></script>"
?>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>