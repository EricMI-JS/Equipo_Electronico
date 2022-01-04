<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<h2 class="subtitulo">Busca una devolución por su ID</h2>

<form class="formulario" action="/devoluciones" method="POST">
    <div class="campo">
        <label for="id">Folio</label>
        <input type="number" id="id" placeholder="Ingresa ID del apartado" name="id" value="">
    </div>
    <input type="submit" class="btn-green" value="Enviar">
</form>

<table class=" tabla">
    <thead class="tabla-encabezado">
        <th>Id Apartado</th>
        <th>fecha</th>
        <th>hora</th>
    </thead>

    <tbody class="tabla-cuerpo">
        <tr>
            <td><?php echo $devolucion->apartadoId ?></td>
            <td><?php echo $devolucion->fecha ?></td>
            <td><?php echo $devolucion->hora ?></td>
        </tr>
    </tbody>
</table>


<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>