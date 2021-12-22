<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class UsuarioController
{

    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $usuarios = Usuario::all();

        $router->renderAdmin('usuarios/index', [
            'titulo' => "Usuarios",
            'nombre' => $_SESSION['nombre'],
            'usuarios' => $usuarios
        ]);
    }

    public static function admin()
    {
        session_start();

        isAdmin();

        $id = $_POST['id'];
        $usuario = Usuario::find($id);
        $usuario->admin = "1";
        $usuario->actualizar();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public static function eliminar()
    {
        session_start();
        isAdmin();
        $id = $_POST['id'];
        $usuario = Usuario::find($id);
        $usuario->eliminar();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}
