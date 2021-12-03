<?php

namespace Model;

class AdminApartado extends ActiveRecord
{
    protected static $tabla = 'apartadosComponentes';
    protected static $columnasDB = ['id', 'hora', 'solicitante', 'email', 'nocontrol', 'componente', 'cantidad'];

    public $id;
    public $hora;
    public $solicitante;
    public $email;
    public $nocontrol;
    public $componente;
    public $cantidad;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->solicitante = $args['solicitante'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->nocontrol = $args['nocontrol'] ?? '';
        $this->componente = $args['componente'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
    }
}
