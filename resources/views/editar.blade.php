<x-app-layout>
    <div class="p-10 m-5">
        <div class="shadow-md backdrop-blur-sm shadow-gray-400">
            <div class="relative flex justify-end w-full -right-5">
                <p class="px-16 py-1 my-4 text-lg text-white rounded-l-lg bg-ipn">Editar Usuario</p>
            </div>
            <div class="px-5">
                <form action="{{ route('actualizar', 1) }}" class="flex flex-col items-center justify-center w-full py-10 justify-items-center" method="POST">
                    @dd($Usuario)
                    @method('PUT')
                    @csrf
                    {{-- Div para errores --}}
                    @if ($errors->any())
                        <div class="w-full">
                            <ul class="flex flex-col items-center justify-center p-5 space-y-1">
                                @foreach ($errors->all() as $error )
                                    <li class="w-1/3 py-2 pl-10 text-white rounded-md bg-ipn">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="grid w-full grid-cols-2">
                        <div class="col-span-1">
                            <div class="flex flex-col items-center justify-center">
                                <img src="/img/QR.png" alt="">
                                <div class="flex justify-center">
                                    <div class="relative py-6">
                                        <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <a href="#" class="px-5 py-3 pl-10 text-white rounded-md bg-ipn">Descargar</a>
                                    </div>
                                </div>
                                <div class="py-6">
                                    <div class="flex items-center justify-center w-full space-x-5">
                                        <p class="text-2xl font-bold text-ipn">Estatus:</p>
                                        <div class="flex">
                                            <input type="checkbox" id="Estatus" class="hidden peer" name="Estatus"/>
                                            <label for="Estatus" class="px-6 py-3 font-bold transition-colors duration-200 ease-in-out border-2 rounded-lg cursor-pointer select-none text-ipn border-ipn peer-checked:bg-ipn-dark peer-checked:text-white peer-checked:border-ipn-dark "> Activo </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 col-span-1 -ml-10">
                            {{-- Input 1 y 2 --}}
                            <div class="flex w-full space-x-10">
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="search"
                                        id="Nombre"
                                        name="Nombre"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Nombre"
                                        value="{{ old('Nombre') }}"
                                    />
                                </div>
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="search"
                                        id="Ap_Paterno"
                                        name="Ap_Paterno"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Apellido paterno"
                                        value="{{ old('Ap_Paterno') }}"
                                    />
                                </div>
                            </div>
                            {{-- Input 3 y 4 --}}
                            <div class="flex w-full space-x-10">
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="search"
                                        id="Ap_Materno"
                                        name="Ap_Materno"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Apellido materno"
                                        value="{{ old('Ap_Materno') }}"
                                    />
                                </div>
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="search"
                                        id="Telefono"
                                        name="Telefono"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Teléfono"
                                        value="{{ old('Telefono') }}"
                                    />
                                </div>
                            </div>
                            {{-- Input 5 y 6 --}}
                            <div class="flex w-full space-x-10">
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                        </svg>
                                    </div>
                                    <select name="ID_Tipo_Usuario" id="ID_Tipo_Usuario" class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent">
                                        @if (!old('ID_Tipo_Usuario'))
                                        <option value="">Selecciona</option>
                                        <option value="1">Docentes</option>
                                        <option value="2">Mixto</option>
                                        <option value="3">Alumno</option>
                                        @else
                                            <option value="{{ old('ID_Tipo_Usuario') }}">Seleccionado</option>
                                            <option value="1">Docentes</option>
                                            <option value="2">Mixto</option>
                                            <option value="3">Alumno</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path fill-rule="evenodd" d="M17.834 6.166a8.25 8.25 0 100 11.668.75.75 0 011.06 1.06c-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788 3.807-3.808 9.98-3.808 13.788 0A9.722 9.722 0 0121.75 12c0 .975-.296 1.887-.809 2.571-.514.685-1.28 1.179-2.191 1.179-.904 0-1.666-.487-2.18-1.164a5.25 5.25 0 11-.82-6.26V8.25a.75.75 0 011.5 0V12c0 .682.208 1.27.509 1.671.3.401.659.579.991.579.332 0 .69-.178.991-.579.3-.4.509-.99.509-1.671a8.222 8.222 0 00-2.416-5.834zM15.75 12a3.75 3.75 0 10-7.5 0 3.75 3.75 0 007.5 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="search"
                                        id="Email"
                                        name="Email"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Correo electrónico"
                                        value="{{ old('Email') }}"
                                    />
                                </div>
                            </div>
                            {{-- Input 7 y 8 --}}
                            <div class="flex w-full space-x-10">
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="date"
                                        id="Permiso.Inicio_Ingreso"
                                        name="Permiso.Inicio_Ingreso"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Ingreso"
                                        value="{{ old('Permiso.Inicio_Ingreso') }}"
                                    />
                                </div>
                                <div class="relative w-full my-2 overflow-hidden rounded-md">
                                    <div class="absolute inset-y-0 left-0 flex items-center px-6 pointer-events-none bg-ipn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="date"
                                        id="Permiso.Fin_Ingreso"
                                        name="Permiso.Fin_Ingreso"
                                        class="w-full pl-20 p-2.5 border-none rounded-r-md bg-ipn text-white placeholder:text-white text-sm focus:ring-transparent"
                                        placeholder="Salida"
                                        value="{{ old('Permiso.Fin_Ingreso') }}"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex py-10 space-x-10 justify-evenly">
                        <a href="{{ route('dashboard') }}" class="px-10 py-3 font-bold text-white bg-red-700 rounded-md">Cancelar</a>
                        <button class="px-10 py-3 font-bold text-white rounded-md bg-ipn">Actualizar</button>
{{-- TODO: Se tiene que cambiar el nombre de fecha ingreso --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>