<?php

namespace Controllers;

use Model\AdminApartado;
use Model\Usuario;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $fechas = explode('-', $fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultar la Base de Datos
        $consulta = "SELECT apartados.id, apartados.hora, CONCAT (usuarios.nombre, ' ', usuarios.apellido) AS solicitante, ";
        $consulta .= " usuarios.nocontrol, componentes.id as foliocomponente, componentes.nombre as componente, apartados.estado ";
        $consulta .= " FROM apartados ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON apartados.apartado_usuarioId=usuarios.id ";
        $consulta .= " LEFT OUTER JOIN apartadoscomponentes ";
        $consulta .= " ON apartadoscomponentes.apartado_apartadoId=apartados.id";
        $consulta .= " LEFT OUTER JOIN componentes";
        $consulta .= " ON componentes.id=apartadoscomponentes.apartado_componenteId ";
        $consulta .= " WHERE fecha = '${fecha}' ";

        // Consultar número de usuarios
        $apartados = AdminApartado::SQL($consulta);

        $router->renderAdmin('admin/index', [
            'titulo' => 'Apartados',
            'nombre' => $_SESSION['nombre'],
            'apartados' => $apartados,
            'fecha' => $fecha
        ]);
    }

    public static function usuarios(Router $router)
    {
        session_start();

        isAuth();

        $consulta = Usuario::all();

        $router->renderAdmin('admin/usuarios', [
            'titulo' => 'Usuarios',
            'nombre' => $_SESSION['nombre'],
            'usuarios' => $consulta
        ]);
    }
}
