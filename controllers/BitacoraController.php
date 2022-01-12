<?php

namespace Controllers;

use Model\Bitacora;
use MVC\Router;
use Dompdf\Dompdf;

class BitacoraController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $bitacora = Bitacora::all();

        $router->renderAdmin('bitacora/index', [
            'titulo' => 'Bitacora',
            'nombre' => $_SESSION['nombre'],
            'bitacora' => $bitacora,
        ]);
    }
}
