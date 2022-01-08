<?php include_once __DIR__ . '/../admin/header-admin.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<h2 class="subtitulo">Crear nueva categoría</h2>

<form class="formulario" action="/categoria/crear" method="POST">
    <label for="categoria">Categoria</label>
    <input type="text" id="categoria" placeholder="Nombre Categoría" name="categoria" value="<?php echo $categoria->nombre; ?>">
    <input type="submit" class="btn-green" value="Guardar">
</form>


<?php include_once __DIR__ . '/../admin/footer-admin.php'; ?>