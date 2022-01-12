<h2 class="subtitulo">Componentes más apartados</h2>

<canvas id="myChart" width="400" height="200"></canvas>

<h2 class="subtitulo">Seleccione una fecha</h2>
<h3>Apartados</h3>
<input id="fechaApartados" value="<?php echo $fecha ?>" type="date"" />
            <?php if (count($apartados) === 0) {
                echo "<h4>No hay citas</h4>";
            } ?>

<table class=" tabla">
<thead class="tabla-encabezado">
    <th>ID</th>
    <th>Solicitante</th>
    <th>Hora</th>
    <th>Componentes</th>
    <th>Estado</th>
    <th>Acciones</th>
</thead>
<tbody class="tabla-cuerpo">
    <?php
    $idApartado = 0;
    // debuguear($apartados);
    foreach ($apartados as $apartado) {
        if ($idApartado !== $apartado->id) {
    ?>
            <tr>
                <td> <?php echo $apartado->id ?></td>
                <td> <?php echo $apartado->solicitante ?></td>
                <td> <?php echo $apartado->hora ?></td>
                <td> <a class="abrir-modal" data-id="<?php echo $apartado->id; ?>" href="#">Ver componentes</a> </td>
                <td class="<?php if ($apartado->estado === '0') {
                                echo "pendiente";
                            } elseif ($apartado->estado === '1') {
                                echo "aprobado";
                            } elseif ($apartado->estado === '2') {
                                echo "rechazado";
                            } ?>"><?php if ($apartado->estado === '0') {
                                        echo "Pendiente";
                                    } elseif ($apartado->estado === '1') {
                                        echo "Aprobado";
                                    } elseif ($apartado->estado === '2') {
                                        echo "Rechazado";
                                    } ?></td>
                <td>
                    <form class="acciones" action="/admin/actualizar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apartado->id; ?>">
                        <input type="hidden" name="usuarioId" value="<?php echo $apartado->usuarioId; ?>">
                        <input type="hidden" name="solicitante" value="<?php echo $apartado->solicitante; ?>">
                        <input type="submit" name="aceptar" value="Prestar" class="btn-green">
                        <input type="submit" name="devolver" value="Devolucion" class="btn-lightBlue">
                        <input type="submit" name="rechazar" value="Rechazar" class="btn-red">
                        <a href="../bitacora">a</a>
                    </form>
                </td>
            </tr>
        <?php
            $idApartado = $apartado->id;
        } //Fin de if 
        ?>
        <p class="lista-componentes" data-folio="<?php echo $apartado->id; ?>"><?php echo "Folio: #" . $apartado->foliocomponente . " " .  $apartado->componente; ?></p>
    <?php } //Fin del foreach 
    ?>
</tbody>
</table>

<div class="contenedor-modal" id="contenedor-modal">
    <div class="modal">
        <button class="boton" id="cerrar-modal">
            Cerrar
        </button>
        <h1>Lista de componentes</h1>
        <ul id="componentes-lista">
        </ul>
    </div>
</div>

<?php
$script = "
            <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
            <script src='build/js/admin.js'></script>
            <script src='build/js/chart.js'></script>
            "
?>