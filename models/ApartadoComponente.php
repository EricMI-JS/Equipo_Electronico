<?php

namespace Model;

class ApartadoComponente extends ActiveRecord
{
    protected static $tabla = 'apartadoscomponentes';
    protected static $columnasDB = ['id', 'apartado_apartadoId', 'apartado_componenteId'];

    public $id;
    public $apartado_apartadoId;
    public $apartado_componenteId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->apartado_apartadoId = $args['apartado_apartadoId'] ?? '';
        $this->apartado_componenteId = $args['apartado_componenteId'] ?? '';
    }
}
