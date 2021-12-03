<?php

namespace Controllers;

use Model\Componente;
use MVC\Router;

class ComponenteController
{
    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $componentes = Componente::all();

        $router->render('componentes/index', [
            'nombre' => $_SESSION['nombre'],
            'componentes' => $componentes
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAdmin();
        $componente = new Componente;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $componente->sincronizar($_POST);

            $alertas = $componente->validar();

            if (empty($alertas)) {
                $componente->guardar();
                header('Location: /componentes');
            }
        }

        $router->render('componentes/crear', [
            'nombre' => $_SESSION['nombre'],
            'componente' => $componente,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();
        isAdmin();

        if (!is_numeric($_GET['id'])) return;

        $componente = Componente::find($_GET['id']);
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $componente->sincronizar($_POST);

            $alertas = $componente->validar();

            if (empty($alertas)) {
                $componente->guardar();
                header('Location: /componentes');
            }
        }

        $router->render('componentes/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'componente' => $componente,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar()
    {
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $componente = Componente::find($id);
            $componente->eliminar();
            header('Location: /componentes');
        }
    }
}
