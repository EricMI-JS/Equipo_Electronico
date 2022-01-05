<?php

namespace Model;

class Devolucion extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'devoluciones';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'apartadoId'];

    public $id;
    public $fecha;
    public $hora;
    public $apartadoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->apartadoId = $args['apartadoId'] ?? '';
    }

    public function validarDevolucion()
    {
        if (!is_numeric($this->id)) {
            self::$alertas['error'][] = 'Debes Agregar un ID Válido';
        }
    }
}
