@extends('layouts.layout')

@section('Contenido')
    <div>
        <p>Nombre: {{"$Usuario->Nombre $Usuario->Ap_Paterno $Usuario->Ap_Materno"}}</p>
        <p>Tipo de Usuario: {{$Usuario->Tipo_Usuario->Tipo_Usuario}}</p>
        <p>Fecha en la que inicia su permiso: {{$Usuario->Permiso->Inicio_Ingreso}}</p>
        <p>Fecha en la que finaliza su permiso: {{$Usuario->Permiso->Fin_Ingreso}}</p>
        <p>Telefono: {{$Usuario->Telefono}}</p>
        <p>Correo Electrónico: {{$Usuario->Email}}</p>
        <img src={{$Usuario->QR->Ruta}}>
        <p>Estatus:
            @if ($Usuario->Estatus== 1)
                Activo
            @else
                Desactivado
            @endif
        </p>
    </div>

@endsection
