<?php

namespace Controllers;

use Model\AdminApartado;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {

        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultar la Base de Datos
        $consulta = "SELECT apartados.id, apartados.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS solicitante, ";
        $consulta .= " usuarios.email, usuarios.nocontrol, componentes.nombre as componente, ";
        $consulta .= " apartadoscomponentes.cantidadComponentes as cantidad ";
        $consulta .= " FROM apartados ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON apartados.usuarioId=usuarios.id ";
        $consulta .= " LEFT OUTER JOIN apartadoscomponentes ";
        $consulta .= " ON apartadoscomponentes.apartadoId=apartados.id";
        $consulta .= " LEFT OUTER JOIN componentes";
        $consulta .= " ON componentes.id=apartadoscomponentes.componenteId ";
        $consulta .= " WHERE fecha = '${fecha}' ";

        $apartados = AdminApartado::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'apartados' => $apartados,
            'fecha' => $fecha
        ]);
    }
}
