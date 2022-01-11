<?php

namespace Model;

class Bitacora extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'bitacora';
    protected static $columnasDB = ['id', 'idApartado', 'fecha_prestamo', 'hora_prestamo', 'solicitante', 'prestador', 'recibidor', 'fecha_devolucion', 'hora_devolucion'];

    public $id;
    public $idApartado;
    public $fecha_prestamo;
    public $hora_prestamo;
    public $solicitante;
    public $prestador;
    public $recibidor;
    public $fecha_devolucion;
    public $hora_devolucion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->idApartado = $args['idApartado'] ?? '';
        $this->fecha_prestamo = $args['fecha_prestamo'] ?? '';
        $this->hora_prestamo = $args['hora_prestamo'] ?? '';
        $this->solicitante = $args['solicitante'] ?? '';
        $this->prestador = $args['prestador'] ?? '';
        $this->recibidor = $args['recibidor'] ?? 'Pendiente';
        $this->fecha_devolucion = $args['recibidor'] ?? '0000-00-00';
        $this->hora_devolucion = $args['hora_devolucion'] ?? '00:00:00';
    }
}
