<?php

namespace Model;

class Apartado extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'apartados';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'estado', 'apartado_usuarioId'];

    public $id;
    public $fecha;
    public $hora;
    public $estado;
    public $apartado_usuarioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->estado = $args['estado'] ?? '0';
        $this->apartado_usuarioId = $args['apartado_usuarioId'] ?? '';
    }
}
