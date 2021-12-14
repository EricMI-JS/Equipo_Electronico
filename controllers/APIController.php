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
            $componente->guardar();
        }

        // Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);

        // $id = $resultado['id'];


        // // Almacena los componentes con el ID del apartado
        // $idComponentes = explode(",", $_POST['componentes']);
        // $cantidadComponentes = explode(',', $_POST['cantidadComponentes']);

        // for ($i = 0; $i < count($idComponentes); $i++) {
        //     $args = [
        //         'apartadoId' => $id,
        //         'componenteId' => $idComponentes[$i],
        //         'cantidadComponentes' => $cantidadComponentes[$i]
        //     ];
        //     $apartadoComponente = new ApartadoComponente($args);
        //     $apartadoComponente->guardar();
        // }


    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $apartado = Apartado::find($id);
            $apartado->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
