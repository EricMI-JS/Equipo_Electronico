<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<h2 class="subtitulo">Listado de devoluciones</h2>

<form class="formulario" action="/devoluciones/buscar" method="POST">
    <div class="campo">
        <label for="id">Folio</label>
        <input type="number" id="id" placeholder="Ingresa ID del apartado" name="id" value="">
    </div>
    <input type="submit" class="btn-green" value="Enviar">
</form>

<?php
?>
<table class=" tabla">
    <thead class="tabla-encabezado">
        <th>Id Apartado</th>
        <th>fecha</th>
        <th>hora</th>
        <th>Acciones</th>
    </thead>

    <tbody class="tabla-cuerpo">
        <tr>
            <td><?php echo $devolucion->id ?></td>
            <td><?php echo $devolucion->fecha ?></td>
            <td><?php echo $devolucion->hora ?></td>
            <td class="acciones">
                <button class="btn-red">Eliminar</button>
            </td>
        </tr>
    </tbody>
</table>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>