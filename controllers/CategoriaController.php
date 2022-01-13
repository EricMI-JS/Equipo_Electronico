<?php

namespace Controllers;

use Model\Componente;
use Model\Categoria;
use Dompdf\Dompdf;

use MVC\Router;

class CategoriaController
{

    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $categorias = Categoria::all();

        $router->renderAdmin('categorias/index', [
            'titulo' => 'Categorías',
            'nombre' => $_SESSION['nombre'],
            'categorias' => $categorias
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        $categoria = new Categoria();
        // $categorias = Categoria::all();
        $alertas = [];

        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST);

            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $categoria->guardar();
                header('Location: /inventario');
            }
        }

        $router->renderAdmin('categorias/crear', [
            'titulo' => 'Crear nueva Categoría',
            'nombre' => $_SESSION['nombre'],
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;

        $categoria = Categoria::find($_GET['id']);
        $alertas = [];
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST);

            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $categoria->actualizar();
                header('Location: /categoria');
            }
        }

        $router->renderAdmin('categorias/actualizar', [
            'titulo' => 'Actualizar Componente',
            'nombre' => $_SESSION['nombre'],
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar()
    {
        isAdmin();
        $id = $_POST['id'];
        $categoria = Categoria::find($id);
        $categoria->eliminar();
        header('Location: /categoria');
    }
}
