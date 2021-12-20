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
        if (!is_numeric($this->id)) {
            self::$alertas['error'][] = 'Debes Agregar un Folio Válido';
        }
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Componente es Obligatorio';
        }
        if (!$this->categoria) {
            self::$alertas['error'][] = 'La Categoría del Componente es Obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La Descripcion del Componente es Obligatorio';
        }

        return self::$alertas;
    }
}
