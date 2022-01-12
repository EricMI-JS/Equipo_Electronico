<?php

namespace Controllers;

use Model\Bitacora;
use MVC\Router;
use Dompdf\Dompdf;

class BitacoraController
{
    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $bitacora = Bitacora::all();


        // $dompdf = new Dompdf();

        // $options = $dompdf->getOptions();
        // $options->set(array('isRemoteEnabled' => true));
        // $dompdf->setOptions($options);

        // $dompdf->setPaper('letter');
        // // $dompdf->setPaper('A4', );

        // $dompdf->loadHtml('Hola develoteca');

        // $dompdf->render();

        // $dompdf->stream("bitacora_.pdf", array("Attachment" => false));


        $router->renderAdmin('bitacora/index', [
            'titulo' => 'Bitacora',
            'nombre' => $_SESSION['nombre'],
            'bitacora' => $bitacora,
        ]);
    }
}
