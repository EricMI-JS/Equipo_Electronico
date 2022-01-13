<?php

namespace Controllers;

use Model\Componente;
use Model\Categoria;
use Dompdf\Dompdf;

use MVC\Router;

class ComponenteController
{

    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $componentes = Componente::all();

        $router->renderAdmin('componentes/index', [
            'titulo' => 'Inventario',
            'nombre' => $_SESSION['nombre'],
            'componentes' => $componentes
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        $componente = new Componente;
        $categorias = Categoria::all();
        $alertas = [];

        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $componente->sincronizar($_POST);

            $alertas = $componente->validar();

            if (empty($alertas)) {
                $componente->guardar();
                header('Location: /inventario');
            }
        }

        $router->renderAdmin('componentes/crear', [
            'titulo' => 'Crear nuevo componente',
            'nombre' => $_SESSION['nombre'],
            'componente' => $componente,
            'categorias' => $categorias,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;

        $componente = Componente::find($_GET['id']);
        $categorias = Categoria::all();
        $alertas = [];
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $componente->sincronizar($_POST);

            $alertas = $componente->validar();

            if (empty($alertas)) {
                $componente->actualizar();
                header('Location: /inventario');
            }
        }

        $router->renderAdmin('componentes/actualizar', [
            'titulo' => 'Actualizar Componente',
            'nombre' => $_SESSION['nombre'],
            'componente' => $componente,
            'categorias' => $categorias,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar()
    {
        isAdmin();
        $id = $_POST['id'];
        $componente = Componente::find($id);
        $componente->eliminar();
        header('Location: /inventario');
    }

    public static function folios(Router $router)
    {
        session_start();
        isAdmin();

        $componentes = Componente::all();

        $router->renderAdmin('folios/index', [
            'titulo' => 'Crear nuevo componente',
            'nombre' => $_SESSION['nombre'],
            'componentes' => $componentes
        ]);
    }
}
