<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;
    public function __construct($email,$nombre,$token)
    {
        $this->email= $email;
        $this->nombre= $nombre;
        $this->token= $token;
    }

    public function enviarEmail(){

        //configurar SMTP
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->SMTPSecure= 'tls';
        $mail->Username = '23b1d2060d3358';
        $mail->Password = '824537f324791d';
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email);
        $mail->Subject= 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cuenta, pudes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body=$contenido;
        $mail->AltBody= 'Esto es un mensaje de App Salon.com';
        
        $mail->send();
    }

    public function enviarInstrucciones(){
        //configurar SMTP
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->SMTPSecure= 'tls';
        $mail->Username = '23b1d2060d3358';
        $mail->Password = '824537f324791d';
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email);
        $mail->Subject= 'Reestablece tu password';

        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=". $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, pudes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body=$contenido;
        $mail->AltBody= 'Esto es un mensaje de App Salon.com';
        
        $mail->send();
    }

}