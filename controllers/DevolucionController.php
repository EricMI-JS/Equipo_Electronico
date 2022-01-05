<?php

namespace Controllers;

use Model\Apartado;
use Model\Devolucion;
use MVC\Router;

class DevolucionController
{

    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $devolucion = new Devolucion();

        $router->renderAdmin('devoluciones/index', [
            'titulo' => "Devoluciones",
            'nombre' => $_SESSION['nombre'],
            'devolucion' => $devolucion
        ]);
    }

    public static function buscar(Router $router)
    {
        $alertas = [];

        session_start();

        isAdmin();

        $id = $_POST['id'];

        $devolucion = Devolucion::where('apartadoId', $id);

        if ($devolucion) {
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }

        $router->renderAdmin('devoluciones/index', [
            'titulo' => "Devoluciones",
            'nombre' => $_SESSION['nombre'],
            'devolucion' => $devolucion
        ]);
    }
}
