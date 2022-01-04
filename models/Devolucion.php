<?php

namespace Model;

class Devolucion extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'devoluciones';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'estado', 'apartadoId'];

    public $id;
    public $fecha;
    public $hora;
    public $estado;
    public $apartadoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->estado = $args['estado'] ?? '0';
        $this->apartadoId = $args['apartadoId'] ?? '';
    }
}
