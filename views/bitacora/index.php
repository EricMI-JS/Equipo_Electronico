<?php include_once __DIR__ . '/../admin/header-admin.php' ?>
<table class="tabla-bitacora">
    <thead class="tabla-encabezado">
        <th>Fecha Prestamo</th>
        <th>Hora Prestamo</th>
        <th>Solicitó</th>
        <th>Prestó</th>
        <th>Recibió</th>
        <th>Fecha Entrega</th>
        <th>Hora Entrega</th>
    </thead>
    <tbody class="tabla-cuerpo">
        <?php
        foreach ($bitacora as $fila) { ?>
            <tr>
                <td><?php echo $fila->fecha_prestamo ?></td>
                <td><?php echo $fila->hora_prestamo ?></td>
                <td><?php echo $fila->solicitante ?></td>
                <td><?php echo $fila->prestador ?></td>
                <td><?php echo $fila->recibidor ?></td>
                <td><?php echo $fila->fecha_devolucion ?></td>
                <td><?php echo $fila->hora_devolucion ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once __DIR__ . '/../admin/footer-admin.php' ?>