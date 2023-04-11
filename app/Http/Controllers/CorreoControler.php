<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

use App\Http\Controllers\PlantillaControler;

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
        $this->Host = env('MAIL_HOST');
        $this->Username = env('MAIL_USERNAME');
        $this->clientId = env('MAIL_CLIENT_ID');
        $this->clientSecret = env('MAIL_CLIENT_SECRET');
        $this->refreshToken = env('MAIL_REFRESH_TOKEN');
        $this->Port =  env('MAIL_PORT');
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

    public function EnviarQR($Usuario)
    {
        $Plantilla = new PlantillaControler();
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
            $mail->addAddress($Usuario->Email);
            // $mail->addBCC($mail->Username);


            //Se define la plantilla que voy a utilizar en el método "Nuevo_Usuario"
            $mail->isHTML(true);
            $mail->Subject = 'Bienvenido a AccesoUPIICSA';

            //Se inserta en el cuerpo la plantilla cargada anteriormente
            $mail->Body    = $Plantilla->NotificacionQR($Usuario);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
        }
    }
}
