<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Usuarios</title>
</head>

<body>
    <div class="container mx-auto">
        <div class="w-full py-3">
            <table class="w-full bg-ipn rounded-t-xl">
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
                    <td>{{$Usuario->ID_Tipo_Usuario->Tipo_Usuario}}</td>
                    <td>{{$Usuario->ID_Permiso->Inicio_Ingreso}}</td>
                    <td>{{$Usuario->ID_Permiso->Fin_Ingreso}}</td>
                    <td>{{$Usuario->Telefono}}</td>
                    <td>{{$Usuario->Email}}</td>
                    <td>{{$Usuario->Estatus}}</td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>


</body>

</html>