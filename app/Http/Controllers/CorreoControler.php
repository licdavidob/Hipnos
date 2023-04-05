<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

class CorreoControler extends Controller
{
    private $Host;
    private $Username;
    private $clientId;
    private $clientSecret;
    private $refreshToken;
    private $Port;
    private $Provider;
    private $OAuth;
    private $mail;

    public function __construct()
    {
        $this->Host = 'smtp.gmail.com';
        $this->Username = 'david.olvera@tsjcdmx.gob.mx';
        $this->clientId = '112239055010-6ml9jedfm8n5uv2f9qqrglvq3b8hp4gn.apps.googleusercontent.com';
        $this->clientSecret = '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';
        $this->refreshToken = '1//0f4UgROH7uTzxCgYIARAAGA8SNwF-L9Ir2gbCh7AAjhoaYvLtHJ5r_3AaF7f_IhBGfqfINQuxSgKy_n1k7mkP50MbOeF45s_PFwo';
        $this->Port =  465;
        $this->mail = new PHPMailer(true);
        $this->DefineProvider()->DefineOAuth();
    }

    public function DefineProvider()
    {

        $this->Provider = new Google(
            [
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret,
            ]
        );

        return $this;
    }

    public function DefineOAuth()
    {
        $this->OAuth = new OAuth(
            [
                'provider' => $this->Provider,
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret,
                'refreshToken' => $this->refreshToken,
                'userName' => $this->Username,
            ]
        );
        return $this;
    }

    public function Correo($Usuario)
    {
        $mail = $this->mail;
        try {

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
            $mail->isSMTP();                                    //Send using SMTP
            $mail->Host       = $this->Host;                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                           //Enable SMTP authentication
            $mail->Username   = $this->Username;                //SMTP username
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
            $mail->Port       = $this->Port;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth($this->OAuth);

            //Recipients
            $mail->setFrom($mail->Username, 'AccesoUPIICSA');
            $mail->addAddress("licdavidob@gmail.com");
            // $mail->addBCC($mail->Username);


            //Se define la plantilla que voy a utilizar en el método "Nuevo_Usuario"
            // $this->Nuevo_Usuario($Usuario);
            // $mail->isHTML(true);
            $mail->Subject = 'Bienvenido al sistema CONATRIB';

            //Se inserta en el cuerpo la plantilla cargada anteriormente
            $mail->Body    = "Enviando código QR";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
        }
    }
}
