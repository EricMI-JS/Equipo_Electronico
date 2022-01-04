<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>

<h2 class="subtitulo">Busca una devolución por su ID</h2>

<form class="formulario" action="/devoluciones/buscar" method="POST">
    <div class="campo">
        <label for="id">Folio</label>
        <input type="number" id="id" placeholder="Ingresa ID del apartado" name="id" value="">
    </div>
    <input type="submit" class="btn-green" value="Enviar">
</form>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>