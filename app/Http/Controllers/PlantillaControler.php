<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantillaControler extends Controller
{
  public function NotificacionQR($Usuario)
  {
    return view('emails.NotificacionQR', compact('Usuario'));
  }
}
