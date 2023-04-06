<x-app-layout>
    <div class="p-10 px-16">
        <div class="shadow-md backdrop-blur-sm shadow-gray-400">
            <div class="relative flex justify-end w-full pt-10 -right-5">
                <p class="px-16 py-1 text-lg text-white rounded-l-lg bg-ipn">Gráficas</p>
            </div>
            {{-- Contenedor de los elementos de la tabla --}}
            <div class="px-5">
                {{-- Contenedor de total de usuarios --}}
                <div class="flex items-center py-10 pl-10 space-x-10">
                    <p class="text-2xl font-bold text-ipn">Total de usuarios</p>
                    <div class="flex items-center justify-center w-28 h-28 border-[15px] rounded-full border-ipn">
                        <p class="text-xl font-bold text-ipn">{{ $Estadistica["Alumno"]+$Estadistica["Docente"]+$Estadistica["Mixto"]}}</p>
                        {{-- <p class="font-bold text-md text-ipn"></p> --}}
                    </div>
                </div>
                <div class="w-full py-5 bg-white">
                    <img src="/img/Graficas.png" alt="">
                </div>
                <div class="relative flex justify-end w-full px-6 py-10">
                    <a href="{{ route('crear') }}"
                      class="p-2 px-5 text-lg font-semibold text-center transition duration-700 ease-out border-4 rounded-md cursor-pointer text-ipn border-ipn hover:bg-ipn hover:text-white"
                      >Nuevo Usuario
                    </a>
                  </div>
                <div class="py-10">
                    <table class="w-full overflow-hidden rounded-md">
                        <thead class="text-center">
                            <tr class="text-white bg-black">
                                <th class="py-7 bg-ipn">Nombre</th>
                                <th class="bg-ipn-1">Tipo</th>
                                <th class="bg-ipn-2">Ingreso</th>
                                <th class="bg-ipn-3">Salida</th>
                                <th class="bg-ipn-4">Estatus</th>
                                <th class="bg-ipn-5">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr class="bg-transparent border-b-2 border-dashed border-ipn">
                                <td class="py-6">David Olvera Baeza</td>
                                <td>Alumno</td>
                                <td>13/03/2023 09:15 a. m.</td>
                                <td>13/03/2023 17:50 p. m.</td>
                                <td>1</td>
                                <td class="flex items-center py-6 space-x-2 justify-evenly">
                                    <p>Editar</p>
                                    <p>Borrar</p>
                                </td>
                            </tr>
                            <tr class="bg-transparent border-b-2 border-dashed border-ipn">
                                <td class="py-6">Vanessa Vivero Reyes</td>
                                <td>Alumno</td>
                                <td>13/03/2023 09:15 a. m.</td>
                                <td>13/03/2023 17:50 p. m.</td>
                                <td>0</td>
                                <td class="flex items-center py-6 space-x-2 justify-evenly">
                                    <p>Editar</p>
                                    <p>Borrar</p>
                                </td>
                            </tr>
                            <tr class="bg-transparent border-b-2 border-dashed border-ipn">
                                <td class="py-6">Uriel Sanjuan Morales</td>
                                <td>Maestro</td>
                                <td>13/03/2023 09:15 a. m.</td>
                                <td>13/03/2023 17:50 p. m.</td>
                                <td>1</td>
                                <td class="flex items-center py-6 space-x-2 justify-evenly">
                                    <p>Editar</p>
                                    <p>Borrar</p>
                                </td>
                            </tr>
                        </tbody>
            
                        {{-- @foreach ($Usuarios as $Usuario)
                        <tr>
                            <td>{{ $Usuario->Nombre." ".$Usuario->Ap_Paterno." ".$Usuario->Ap_Materno }} </td>
                            <td>{{$Usuario->Tipo_Usuario->Tipo_Usuario}}</td>
                            <td>{{$Usuario->Permiso->Inicio_Ingreso}}</td>
                            <td>{{$Usuario->Permiso->Fin_Ingreso}}</td>
                            <td>{{$Usuario->Estatus}}</td>
                            <td>Acciones</td>
                            <td>
                                @if ($Usuario->Estatus== 1)
                                <p>Activo</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>