<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" placeholder="Nombre Componente" name="nombre" value="<?php echo $componente->nombre; ?>">
</div>

<div class="campo">
    <label for="categoria">Categoria</label>
    <select name="categoria" id="categoria">
        <?php
        foreach ($categorias as $categoria) { ?>
            <option value="<?php echo $categoria->nombre ?>"><?php echo $categoria->nombre ?></option>
        <?php } ?>
    </select>
</div>