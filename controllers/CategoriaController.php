<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;

class CategoriaController
{
    public static function crear(Router $router)
    {
        session_start();
        isAdmin();
        $categoria = new Categoria;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevaCategoria = $_POST['categoria'];
            $categoria->nombre = $nuevaCategoria;

            $alertas = $categoria->validar();


            if (empty($alertas)) {
                $categoria->guardar();
                header('Location: /inventario');
            }
        }

        $router->renderAdmin('categorias/crear', [
            'titulo' => 'Categorias',
            'nombre' => $_SESSION['nombre'],
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }
}
