<h2 class="subtitulo">Seleccione una fecha</h2>
<input id="fechaApartados" value="<?php echo $fecha ?>" type="date"" />
            <?php if (count($apartados) === 0) {
                echo "<h4>No hay citas</h4>";
            } ?>

<table class=" tabla">
<thead class="tabla-encabezado">
    <th>Id Apartado</th>
    <th>Solicitante</th>
    <th>Hora</th>
    <th>Estado</th>
    <th>Acciones</th>
</thead>
<?php
$idApartado = 0;
foreach ($apartados as $apartado) {
    if ($idApartado !== $apartado->id) {
?>
        <tbody class="tabla-cuerpo">
            <tr>
                <td><?php echo $apartado->id ?></td>
                <td><?php echo $apartado->solicitante ?></td>
                <td><?php echo $apartado->hora ?></td>
                <!-- <td><?php if ($apartado->estado === '0') echo "Pendiente" ?></td> -->
                <td class="<?php if ($apartado->estado === '0') {
                                echo "pendiente";
                            } elseif ($apartado->estado === '1') {
                                echo "aprobado";
                            } elseif ($apartado->estado === '2') {
                                echo 'rechazado';
                            } ?>"><?php if ($apartado->estado === '0') {
                                        echo "Pendiente";
                                    } elseif ($apartado->estado === '1') {
                                        echo "Aprobado";
                                    } elseif ($apartado->estado === '2') {
                                        echo 'Rechazado';
                                    } ?></td>
                <td>
                    <form class="acciones" action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apartado->id; ?>">
                        <input type="submit" name="aceptar" class="btn-green" value="Aceptar">
                        <input type="submit" name="rechazar" class="btn-red" value="Rechazar">
                    </form>
                </td>
            </tr>
        </tbody>
    <?php
        $idApartado = $apartado->id;
    } // Fin de if 
    ?>

<?php
} // Fin del foreach 
?>
</table>