<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" action="/inventario/crear" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" class="btn-green" value="Guardar">
</form>

<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>