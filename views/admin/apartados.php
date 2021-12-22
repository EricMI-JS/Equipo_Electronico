<h2 class="subtitulo">Seleccione una fecha</h2>
<input id="fechaApartados" value="<?php echo $fecha ?>" type="date"" />
            <?php if (count($apartados) === 0) {
                echo "<h4>No hay citas</h4>";
            } ?>

<table class=" tabla">
<thead class="tabla-encabezado">
    <th>Solicitante</th>
    <th>Hora</th>
    <th>Estado</th>
    <th>Componentes</th>
    <th>Acciones</th>
</thead>
<tbody class="tabla-cuerpo">
    <?php
    $idApartado = 0;
    foreach ($apartados as $apartado) {
        if ($idApartado !== $apartado->id) {
    ?>
            <tr>
                <td> <?php echo $apartado->solicitante ?></td>
                <td> <?php echo $apartado->hora ?></td>
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
                <td> <a class="abrir-modal" data-id="<?php echo $apartado->id; ?>" href="#">Ver componentes</a> </td>
                <td>
                    <form class="acciones" action="/admin/actualizar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apartado->id; ?>">
                        <input type="submit" name="aceptar" value="Aceptar" class="btn-green">
                        <input type="submit" name="rechazar" value="Rechazar" class="btn-red">
                    </form>
                    </div>
                </td>
            </tr>
        <?php
            $idApartado = $apartado->id;
        } //Fin de if 
        ?>
        <p class="lista-componentes" data-folio="<?php echo $apartado->id; ?>"><?php echo $apartado->foliocomponente . " - #" . $apartado->componente; ?></p>
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
$script = "<script src='build/js/admin.js'></script>"
?>