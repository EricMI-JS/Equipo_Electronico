<?php

namespace Controllers;

use Model\Devolucion;
use MVC\Router;

class DevolucionController
{

    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $router->renderAdmin('devoluciones/index', [
            'titulo' => "Devoluciones",
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function buscar(Router $router)
    {
        session_start();

        isAdmin();

        $id = $_POST['id'];

        $devolucion = Devolucion::find($id);

        $router->renderAdmin('devoluciones/buscar', [
            'titulo' => "Devoluciones",
            'nombre' => $_SESSION['nombre'],
            'devolucion' => $devolucion
        ]);
    }
}
