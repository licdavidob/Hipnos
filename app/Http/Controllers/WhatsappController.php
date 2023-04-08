<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    private string $url = 'https://graph.facebook.com/v16.0/102166226187858/messages';
    private string $Token = 'EAAUYc2FcqW0BACPAFbwQcqgP7ZAKOd1hdtZAfIMbZAkeoqdlhfVey6pC6CuCOwZBHQBWwVWAnFlPw8nkJZAD5SQQVpGnaJBp0E00YnOZCBQYn0Y1NvNNskpmLWQ2IC5vXJZBhRRDXGz2H0zt2m2G5mVKV7I0WvPRZCd3htdzQoKZC2xjD5nZBkhaaNyZA5ZAQaAQwauFbOhmlClZCFSG9ARZC1Wvn6ZAbV5FYJUc1YZD';
    private array $Header = array();
    private array $Message = array();
    private array $Templade = array();
    private array $language = array();

    public function __construct()
    {
        $this->language = array('code' => 'en_US');

        $this->Templade = array(
            'name' => 'hello_world',
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
