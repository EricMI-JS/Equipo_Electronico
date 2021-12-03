<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar Apartados</h2>

<div class="busqueda">
    <div class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </div>
</div>

<?php
if (count($apartados) === 0) {
    echo "<h3>No encontramos citas en esta fecha</h3>";
}
?>

<div class="apartados-admin">
    <ul class="apartados">
        <?php
        $idApartado = 0;
        foreach ($apartados as $key => $apartado) {
            if ($idApartado !== $apartado->id) {
                $total = 0;
        ?>
                <li>
                    <p>ID: <span><?php echo $apartado->id; ?></span></p>
                    <p>Hora: <span><?php echo $apartado->hora; ?></span></p>
                    <p>Solicitante: <span><?php echo $apartado->solicitante; ?></span></p>
                    <p>Email: <span><?php echo $apartado->email; ?></span></p>
                    <p>No. Control: <span><?php echo $apartado->nocontrol; ?></span></p>

                    <h3>Componentes</h3>
                <?php
                $idApartado = $apartado->id;
            } // fin de if
            $total += $apartado->cantidad
                ?>
                <p class="componente"><?php echo $apartado->componente . " " . $apartado->cantidad; ?></p>

                <?php
                $actual = $apartado->id;
                $proximo = $apartados[$key + 1]->id ?? 0;

                if (esUltimo($actual, $proximo)) { ?>
                    <p class="total">Total de componentes: <span><?php echo $total; ?></span></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apartado->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>
                <?php
                }
                ?>

            <?php } // Fin de foreach 
            ?>
    </ul>
</div>

<?php
$script = "<script src='build/js/buscador.js'></script>"
?>