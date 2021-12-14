<?php

namespace Model;

class Componente extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'componentes';
    protected static $columnasDB = ['id', 'nombre', 'categoria', 'descripcion', 'estado'];

    public $id;
    public $nombre;
    public $categoria;
    public $descripcion;
    public $estado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estado = $args['estado'] ?? '0';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Componente es Obligatorio';
        }
        if (!$this->cantidad) {
            self::$alertas['error'][] = 'El Cantidad del Componente es Obligatorio';
        }
        if (!is_numeric($this->cantidad)) {
            self::$alertas['error'][] = 'La cantidad no es válida';
        }

        return self::$alertas;
    }
}
