<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e7b683607048db';
        $mail->Password = 'f91f344a98b726';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('tesci@correo.com');
        $mail->addAddress('tesci@correo.com', 'TESCI.com');
        $mail->Subject = 'Confirma tu cuenta';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Haz creado tu cuenta en Equipo Electrónico de TESCI. solo debes confirmarla presionando el siguiente enlcace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token="
            . $this->token . "'>Confirmar cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e7b683607048db';
        $mail->Password = 'f91f344a98b726';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('tesci@correo.com');
        $mail->addAddress('tesci@correo.com', 'tesci.edu');
        $mail->Subject = 'Reestablece tu contraseña';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> ¿Solicitaste reestablecer tu contraseña?</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token="
            . $this->token . "'>Reestablecer contraseña</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}
