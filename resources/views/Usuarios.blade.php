<x-app-layout>
    <div class="p-10 px-16">
        {{-- @dd($Estadistica["Nombre"]) --}}
        <div class="shadow-md backdrop-blur-sm shadow-gray-400">
            <div class="relative flex justify-end w-full pt-10 -right-5">
                <p class="text-center py-3 w-60 text-lg text-white rounded-l-lg bg-ipn">Gráficas</p>
            </div>
            {{-- Contenedor de los elementos de la tabla --}}
            <div class="px-5">
                {{-- Contenedor de total de usuarios --}}
                <div class="flex items-center py-10 pl-10 space-x-10">
                    <p class="text-4xl font-bold text-ipn">Total de usuarios</p>
                    <div class="flex items-center justify-center w-28 h-28 border-[15px] rounded-full border-ipn shadow-inner">
                        <p class="text-4xl font-bold text-ipn-gray">{{ $Estadistica["Total"]}}</p>
                    </div>
                </div>
                @if ($Estadistica["Total"] == 0)
                    <div class="w-full py-5 flex justify-center items-center h-[400px]">
                        <div class="flex justify-center items-center p-5 rounded-md">
                            <div class="w-20 bg-red-700 flex justify-center items-center h-20 rounded-l-xl">
                                <img src="/img/eliminarWhite.png" alt="icon alert" class="h-10 w-10">
                            </div>
                            <div class="h-20 flex flex-col justify-center items-center bg-white px-5 rounded-r-xl">
                                <p class=" self-start font-bold text-xl text-red-700">Error</p>
                                <p class="font-bold text-ipn-dark">No hay datos para mostrar la gráfica, por favor ingrese un registro</p>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="w-full py-5 flex justify-evenly items-center h-max-[400px] bg-white rounded-lg shadow-xl">
                        {{-- <div class="w-full h-full flex justify-center items-center space-x-20"> --}}
                        <div class="grid grid-cols-1 xl:grid-cols-2 w-full h-full place-content-center gap-x-5">
                            <div class=" col-span-1 w-full h-full">
                                <div class="flex justify-center items-center px-5">
                                    <canvas id="graficaPrincipal"></canvas>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="flex flex-col justify-evenly h-full pt-4 w-full px-5">
                                    <div class="flex items-center w-full xl:w-[200px] justify-evenly xl:justify-between">
                                        <p class="mx-4 xl:ml-0 xl:mr-4 font-bold text-ipn text-lg">Alumno</p>
                                        <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn-1 shadow-inner">
                                            <p>{{ $Estadistica["Alumno"] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-full xl:w-[200px] justify-evenly xl:justify-between">
                                        <p class="mx-4 xl:ml-0 xl:mr-4 font-bold text-ipn text-lg">Docente</p>
                                        <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn-3 shadow-inner">
                                            <p>{{ $Estadistica["Docente"] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-full xl:w-[200px] justify-evenly xl:justify-between">
                                        <p class="mx-4 xl:ml-0 font-bold text-ipn text-lg pl-5 xl:pl-0">Mixto</p>
                                        <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn-5 shadow-inner">
                                            <p>{{ $Estadistica["Mixto"] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="relative flex justify-end w-full px-6 py-10">
                    <a href="{{ route('crear') }}"
                        class="p-2 px-5 text-lg font-semibold text-center transition duration-700 ease-out border-4 rounded-md cursor-pointer text-ipn border-ipn hover:bg-ipn hover:text-white"
                        >Nuevo Usuario
                    </a>
                </div>
                <div class="py-10 overflow-x-auto">
                    <table class="w-full overflow-hidden rounded-md">
                        <thead class="text-center">
                            <tr class="text-white bg-black">
                                <th class="py-7 bg-ipn px-16">Nombre</th>
                                <th class="bg-ipn-1 px-5">Tipo</th>
                                <th class="bg-ipn-2 px-10">Ingreso</th>
                                <th class="bg-ipn-3 px-10">Salida</th>
                                <th class="bg-ipn-4 px-5">Estatus</th>
                                <th class="bg-ipn-5 px-5">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($Usuarios as $Usuario)
                            <tr class="bg-transparent border-b-2 border-dashed border-ipn">
                                <td class="py-6">{{ $Usuario->Nombre." ".$Usuario->Ap_Paterno." ".$Usuario->Ap_Materno }}</td>
                                <td>{{ $Usuario->Tipo_Usuario->Tipo_Usuario }}</td>
                                <td>{{  $Usuario->Permiso->Inicio_Ingreso  }}</td>
                                <td>{{ $Usuario->Permiso->Fin_Ingreso }}</td>
                                <td>
                                    @if($Usuario->Estatus)
                                        Activo
                                    @else
                                        Desactivado
                                    @endif
                                </td>
                                <td class="flex items-center py-6 space-x-2 justify-evenly">
                                    <div class="flex items-center justify-center w-6 h-6 mr-1 rounded-lg bg-ipn">
                                        <div class="w-4 duration-300 ease-in-out transform-all hover:scale-110">
                                            <a href="{{ route('editar', $Usuario->ID_Usuario) }}"><img src="/img/editW.png" alt="edit"></a>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-ipn">
                                        <div class="w-4 mt-1 duration-300 ease-in-out transform-all hover:scale-110">
                                            <form action="{{ route('borrar',$Usuario->ID_Usuario) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <img src="/img/deleteW.png" alt="borrar">
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var Estadistica = @json($Estadistica);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/grafica.js"></script>
</x-app-layout>