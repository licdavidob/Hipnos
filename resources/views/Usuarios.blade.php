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
                <div class="w-full py-5 flex justify-evenly items-center h-[400px] bg-white rounded-lg shadow-xl">
                    <div class="w-full h-full flex justify-center items-center space-x-20">
                        {{-- <p class="w-full font-bold text-center block">Hola</p> --}}
                        <canvas id="myChart"></canvas>
                        <div class="flex flex-col justify-evenly h-full pt-4 w-1/4">
                            <div class="flex justify-around items-center">
                                <p class="mr-4 font-bold text-ipn text-lg">Alumno</p>
                                <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn shadow-inner">
                                    <p>{{ $Estadistica["Alumno"] }}</p>
                                </div>
                            </div>
                            <div class="flex justify-around items-center">
                                <p class="mr-4 font-bold text-ipn text-lg">Docente</p>
                                <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn shadow-inner">
                                    <p>{{ $Estadistica["Docente"] }}</p>
                                </div>
                            </div>
                            <div class="flex justify-around items-center">
                                <p class="mr-4 font-bold text-ipn text-lg">Mixto</p>
                                <div class="flex items-center justify-center w-20 h-20 border-[12px] rounded-full border-ipn shadow-inner">
                                    <p>{{ $Estadistica["Mixto"] }}</p>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    {{-- <div class="w-1/2 h-96">
                        <canvas id="mySecondChart"></canvas>
                    </div> --}}
                    {{-- <img src="/img/Graficas.png" alt=""> --}}
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
    <script src="assets/js/sample-chart.js"></script>
</x-app-layout>