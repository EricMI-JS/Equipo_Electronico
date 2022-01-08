    <div class="campo">
        <label for="id">Folio</label>
        <input type="text" id="id" placeholder="Folio" name="id" value="<?php echo $componente->id; ?>">
    </div>

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Nombre Servicio" name="nombre" value="<?php echo $componente->nombre; ?>">
    </div>

    <div class="campo">
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <?php
            foreach ($categorias as $categoria) { ?>
                <option value="<?php $categoria->nombre ?>"><?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="campo">
        <label for="descripcion">Descripcion</label>
        <input type="text" id="descripcion" placeholder="Descripcion" name="descripcion" value="<?php echo $componente->descripcion; ?>">
    </div>