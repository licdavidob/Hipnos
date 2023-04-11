<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    private string $url;
    private string $Token;
    private array $Header;
    private array $Message;
    private array $Templade;
    private array $language;

    public function __construct()
    {
        $this->url = env('WHATSAPP_URL');
        $this->Token = env('WHATSAPP_TOKEN');

        $this->language = array('code' => 'es_MX');

        $this->Templade = array(
            'name' => 'welcome_accesoupiicsa',
            'language' => $this->language
        );

        $this->Header = array(
            "Authorization: Bearer $this->Token",
            'Content-Type: application/json'
        );

        $this->Message = array(
            'messaging_product' => "whatsapp",
            'to' => '',
            'type' => 'template',
            'template' => $this->Templade
        );
    }
    public function EnviarQR($Usuario)
    {
        $this->Message['to'] = "52$Usuario->Telefono";
        $curl = curl_init();
        $Message = json_encode($this->Message);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $Message);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->Header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return true;
    }
}
