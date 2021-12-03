<?php

namespace Model;

class ApartadoComponente extends ActiveRecord
{
    protected static $tabla = 'apartadoscomponentes';
    protected static $columnasDB = ['id', 'apartadoId', 'componenteId', 'cantidadComponentes'];

    public $id;
    public $apartadoId;
    public $servicioId;
    public $cantidadComponentes;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->apartadoId = $args['apartadoId'] ?? '';
        $this->componenteId = $args['componenteId'] ?? '';
        $this->cantidadComponentes = $args['cantidadComponentes'] ?? '';
    }
}
