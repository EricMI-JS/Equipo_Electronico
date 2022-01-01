<?php

namespace Controllers;

use Model\Apartado;
use Model\ApartadoComponente;
use Model\Componente;

class APIController
{

    public static function index()
    {
        $componentes = Componente::all();
        echo json_encode($componentes);
    }

    public static function apartadosComponentes()
    {
        $apartadosComponentes = ApartadoComponente::all();
        echo json_encode($apartadosComponentes);
    }

    public static function guardar()
    {
        // Almacena el apartado y devuelve el ID
        $apartado = new Apartado($_POST);
        $resultado = $apartado->guardar();

        $id = $resultado['id'];

        // Almacena los apartados y los componentes
        $idComponentes = explode(',', $_POST['componentes']);
        foreach ($idComponentes as $idComponente) {
            $args = [
                'apartado_apartadoId' => $id,
                'apartado_componenteId' => $idComponente
            ];
            $apartadoComponente = new ApartadoComponente($args);
            $apartadoComponente->guardar();

            $componente = Componente::where('id', $idComponente);
            $componente->estado = "1";
            $componente->actualizar();
        }

        // Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $apartado = Apartado::find($id);

            if ($_POST['aceptar']) {
                $apartado->estado = "1";
                $apartado->guardar();
                header('Location:' . $_SERVER['HTTP_REFERER']);
            } else {
                $apartado->estado = "2";
                $apartado->guardar();
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
