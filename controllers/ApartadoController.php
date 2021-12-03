<?php

namespace Controllers;

use MVC\Router;

class ApartadoController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $router->render('apartado/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}
