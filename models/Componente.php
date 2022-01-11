<?php

namespace Model;

class Componente extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'componentes';
    protected static $columnasDB = ['id', 'nombre', 'categoria', 'estado'];

    public $id;
    public $nombre;
    public $categoria;
    public $estado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Componente es Obligatorio';
        }
        if (!$this->categoria) {
            self::$alertas['error'][] = 'La Categoría del Componente es Obligatorio';
        }

        return self::$alertas;
    }
}
