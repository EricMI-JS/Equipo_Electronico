<?php

namespace Model;

class AdminApartado extends ActiveRecord
{
    protected static $tabla = 'apartadoscomponentes';
    protected static $columnasDB = ['id', 'hora', 'usuarioId', 'solicitante', 'clave_prof', 'foliocomponente', 'componente', 'estado'];

    public $id;
    public $hora;
    public $usuarioId;
    public $solicitante;
    public $clave_prof;
    public $foliocomponente;
    public $componente;
    public $estado;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->solicitante = $args['solicitante'] ?? '';
        $this->clave_prof = $args['clave_prof'] ?? '';
        $this->foliocomponente = $args['foliocomponente'] ?? '';
        $this->componente = $args['componente'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}
