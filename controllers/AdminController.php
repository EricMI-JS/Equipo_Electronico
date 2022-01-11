<?php

namespace Controllers;

use Model\AdminApartado;
use Model\Apartado;
use Model\ApartadoComponente;
use Model\Bitacora;
use Model\Componente;
use Model\Usuario;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();

        isAuth();

        $alertas = [];

        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $fechas = explode('-', $fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultar la Base de Datos
        $consulta = "SELECT apartados.id, apartados.hora, usuarios.id AS usuarioId, CONCAT (usuarios.nombre, ' ', usuarios.apellido) AS solicitante, ";
        $consulta .= " usuarios.clave_prof, componentes.id as foliocomponente, componentes.nombre as componente, apartados.estado ";
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

    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);
            session_start();
            $id = $_POST['id'];
            $bitacora = new Bitacora;

            // Si se acepta el préstamo
            if (isset($_POST['aceptar'])) {

                // Tomamos datos bitácora
                $solicitante = $_POST['solicitante'];
                $prestador = $_SESSION['nombre'];
                $fecha_prestamorestamo = date('Y-m-d');
                $hora_prestamorestamo = date('H:i:s');

                // Buscamos si ya existe
                $existe = Bitacora::where('idApartado', $id);
                if ($existe) {
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                    return;
                }

                // Insertamos datos de prestámo a la bitácora
                $bitacora->idApartado = $id;
                $bitacora->fecha_prestamo = $fecha_prestamorestamo;
                $bitacora->hora_prestamo = $hora_prestamorestamo;
                $bitacora->solicitante = $solicitante;
                $bitacora->prestador = $prestador;
                $bitacora->guardar();

                // Actualizamos estado de apartado
                $apartado = Apartado::find($id);
                $apartado->estado = "1";
                $apartado->actualizar();
                $apartados = ApartadoComponente::whereAll("apartado_apartadoId", $id);
                header('Location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            // Si se rechaza el préstamo
            if (isset($_POST['rechazar'])) {
                $rechazar = Bitacora::where('idApartado', $id);
                $rechazar->eliminar();

                // Cambiamos estado de apartado
                $apartado = Apartado::find($id);
                $apartado->estado = "2";
                $apartado->actualizar();

                // Habilitamos componentes
                $apartados = ApartadoComponente::whereAll("apartado_apartadoId", $id);
                foreach ($apartados as $apartado) {
                    $componente = Componente::find($apartado->apartado_componenteId);
                    $componente->estado = '0';
                    $componente->actualizar();
                    header('Location: /inventario');
                }
                return;
            }

            if (isset($_POST['devolver'])) {
                // Datos de devolución
                $fechaDevolucion = date('Y-m-d');
                $horaDevolucion = date('H:i:s');
                $receptor = $_SESSION['nombre'];

                $devolucion = Bitacora::where('idApartado', $id);

                if ($devolucion === null) {
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                    return;
                }

                // Agregamos datos a la BD
                $devolucion->recibidor = $receptor;
                $devolucion->fecha_devolucion = $fechaDevolucion;
                $devolucion->hora_devolucion = $horaDevolucion;
                $devolucion->actualizar();

                // Habilitamos componentes
                $apartados = ApartadoComponente::whereAll("apartado_apartadoId", $id);
                foreach ($apartados as $apartado) {
                    $componente = Componente::find($apartado->apartado_componenteId);
                    $componente->estado = '0';
                    $componente->actualizar();
                    header('Location: /inventario');
                }
            }
        }
    }
}
