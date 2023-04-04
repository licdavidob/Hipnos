@extends('layouts.layout')

@section('Contenido')
    <div class="container mx-auto bg-gray-900">
        <div class="bg-gray-900">
            <table class="w-full rounded-t-xl">
                <thead class="text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Tipo Usuario</th>
                    <th>Inicio Ingreso</th>
                    <th>Fin Ingreso</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estatus</th>
                </tr>
                </thead>

                @foreach ($Usuarios as $Usuario)
                    <tr>
                        <td>{{$Usuario->Nombre}}</td>
                        <td>{{$Usuario->Ap_Paterno}}</td>
                        <td>{{$Usuario->Ap_Materno}}</td>
                        <td>{{$Usuario->Tipo_Usuario->Tipo_Usuario}}</td>
                        <td>{{$Usuario->Permiso->Inicio_Ingreso}}</td>
                        <td>{{$Usuario->Permiso->Fin_Ingreso}}</td>
                        <td>{{$Usuario->Telefono}}</td>
                        <td>{{$Usuario->Email}}</td>
                        <td>
                            @if ($Usuario->Estatus== 1)
                                <p>Activo</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

@endsection
