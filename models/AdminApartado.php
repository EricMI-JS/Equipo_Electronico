<?php

namespace Model;

class AdminApartado extends ActiveRecord
{
    protected static $tabla = 'apartadoscomponentes';
    protected static $columnasDB = ['id', 'hora', 'solicitante', 'nocontrol', 'foliocomponente', 'componente', 'estado'];

    public $id;
    public $hora;
    public $solicitante;
    public $nocontrol;
    public $foliocomponente;
    public $componente;
    public $estado;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->solicitante = $args['solicitante'] ?? '';
        $this->nocontrol = $args['nocontrol'] ?? '';
        $this->foliocomponente = $args['foliocomponente'] ?? '';
        $this->componente = $args['componente'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}
