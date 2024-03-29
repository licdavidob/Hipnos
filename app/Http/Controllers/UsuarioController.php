<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\CorreoControler;
use App\Http\Controllers\WhatsappController;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ap_Paterno;
    public ?string $Ap_Materno;
    public object $Tipo_Usuario;
    public object $Permiso;
    public ?string $Telefono;
    public ?string $Email;
    public ?object $QR;
    public int $Estatus;


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $Usuarios = array();
        $Estadistica = array(
            "Total" => 0,
            "Alumno" => 0,
            "Docente" => 0,
            "Mixto" => 0,
        );

        $BusquedaUsuarios = Usuario::where('Visible', 1)->get();
        foreach ($BusquedaUsuarios as $Usuario) {
            $this->ModeltoObject($Usuario);
            $Usuarios[] = $this->getUsuario();
            $Estadistica[$this->Tipo_Usuario->Tipo_Usuario]++;
            $Estadistica['Total']++;
        }

        return view('Usuarios', compact('Usuarios', 'Estadistica'));
    }

    /**
     * @param int $id_usuario
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id_usuario)
    {
        $BusquedaUsuario = $this->usuarioById($id_usuario);
        $Usuario = $this->modelToObject($BusquedaUsuario)->getUsuario();
        $QR = new GenerarQR();
        $QR->modelToObject($BusquedaUsuario->CodigoQR)->existsQR();
        $Usuario->QR = $QR;

        return view('editar', compact('Usuario'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'P_Inicio_Ingreso' => ['required', 'date'],
            'P_Fin_Ingreso' => ['required', 'date'],
            'Telefono' => ['unique:usuario,Telefono', 'max:15', 'nullable'],
            'Email' => ['unique:usuario,Email', 'max:50', 'nullable', 'email',],
        ]);

        $Permiso = new PermisoController();
        $Permiso->Inicio_Ingreso = $request->P_Inicio_Ingreso;
        $Permiso->Fin_Ingreso = $request->P_Fin_Ingreso;
        $Permiso->store($Permiso)->latestPermiso();

        Usuario::create([
            'Nombre' => $request->Nombre,
            'Ap_Paterno' => $request->Ap_Paterno,
            'Ap_Materno' => $request->Ap_Materno,
            'ID_Tipo_Usuario' => $request->ID_Tipo_Usuario,
            'ID_Permiso' => $Permiso->ID_Permiso,
            'Telefono' => $request->Telefono,
            'Email' => $request->Email,
        ]);

        $Usuario = $this->latestUsuario()->getUsuario();
        $QR = new GenerarQR();
        $QR->store($Usuario);
        $Usuario->QR = $QR;

        if ($Usuario->Telefono) {
            $Whatsapp = new WhatsappController();
            $Whatsapp->EnviarQR($Usuario);
        }

        if ($Usuario->Email) {
            $Correo = new CorreoControler();
            $Correo->EnviarQR($Usuario);
        }

        return redirect()->route('Usuario.index');
    }

    /**
     * @param Request $request
     * @param $id_usuario
     * @return RedirectResponse
     */
    public function update(Request $request, $id_usuario)
    {
        $request->Estatus ? $request->Estatus = 1 : $request->Estatus = 0;
        $request->validate([
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'P_Inicio_Ingreso' => ['required', 'date'],
            'P_Fin_Ingreso' => ['required', 'date'],
            //Permite actualizar un usuario con email y telefono unico
            //Tercer parametro: ID usuario
            //Cuarto parametro: Llave primaria
            'Telefono' => ['unique:usuario,Telefono,' . $id_usuario . ',ID_Usuario', 'max:15', 'nullable'],
            'Email' => ['unique:usuario,Email,' . $id_usuario . ',ID_Usuario', 'max:50', 'nullable', 'email'],
        ]);

        $BusquedaUsuario = $this->usuarioById($id_usuario);

        //Actualizar permiso
        // $PermisoRequest = $request->Permiso;
        $Permiso = new PermisoController();

        $Permiso->Inicio_Ingreso = $request->P_Inicio_Ingreso;
        $Permiso->Fin_Ingreso = $request->P_Fin_Ingreso;
        $Permiso->update($BusquedaUsuario->ID_Permiso);

        //Actualizar Usuario
        $BusquedaUsuario->Nombre = $request->Nombre;
        $BusquedaUsuario->Ap_Paterno = $request->Ap_Paterno;
        $BusquedaUsuario->Ap_Materno = $request->Ap_Materno;
        $BusquedaUsuario->ID_Tipo_Usuario = $request->ID_Tipo_Usuario;
        $BusquedaUsuario->Telefono = $request->Telefono;
        $BusquedaUsuario->Email = $request->Email;
        $BusquedaUsuario->Estatus = $request->Estatus;
        $BusquedaUsuario->save();


        return redirect()->route('Usuario.index');
    }


    /**
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id)
    {
        $Busqueda = $this->usuarioById($id);
        $Busqueda->Visible = 0;
        $Busqueda->save();
        return redirect()->route('Usuario.index');
    }

    public function latestUsuario(): static
    {
        $UsuarioInsertado = Usuario::latest('ID_Usuario')->first();
        $this->ModeltoObject($UsuarioInsertado);

        return $this;
    }

    /**
     * @param int $id_usuario
     * @param bool $error404
     * @return false|never
     */
    public function usuarioById(int $id_usuario, bool $error404 = true)
    {
        $Busqueda = Usuario::find($id_usuario);

        if ($Busqueda) {
            return $Busqueda;
        }

        if ($error404) {
            return abort(404);
        }

        return false;
    }

    /**
     * @return UsuarioController
     */
    public function getUsuario(): UsuarioController
    {
        $Usuario = new UsuarioController();
        $Usuario->ID_Usuario = $this->ID_Usuario;
        $Usuario->Nombre = $this->Nombre;
        $Usuario->Ap_Paterno = $this->Ap_Paterno;
        $Usuario->Ap_Materno = $this->Ap_Materno;
        $Usuario->Tipo_Usuario = $this->Tipo_Usuario;
        $Usuario->Permiso = $this->Permiso;
        $Usuario->Telefono = $this->Telefono;
        $Usuario->Email = $this->Email;
        $Usuario->QR = $this->QR;
        $Usuario->Estatus = $this->Estatus;

        return $Usuario;
    }

    /**
     * @param $ModelUsuario
     * @return $this
     */
    public function modelToObject($ModelUsuario): static
    {
        $this->ID_Usuario = $ModelUsuario->ID_Usuario;
        $this->Nombre = $ModelUsuario->Nombre;
        $this->Ap_Paterno = $ModelUsuario->Ap_Paterno;
        $this->Ap_Materno = $ModelUsuario->Ap_Materno;
        $this->Tipo_Usuario = $ModelUsuario->Tipo_Usuario;
        $this->Permiso = $ModelUsuario->Permiso;
        $this->Telefono = $ModelUsuario->Telefono;
        $this->Email = $ModelUsuario->Email;
        $this->QR = $ModelUsuario->CodigoQR;
        $this->Estatus = $ModelUsuario->Estatus;

        return $this;
    }
}
