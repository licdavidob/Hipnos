<x-guest-layout>
    {{-- Loggin Modificado --}}
    <div class="flex flex-col items-center justify-center h-screen py-8">
        <div class="flex flex-col items-center">
            <div class="w-[400px] p-5 flex flex-col items-center justify-center backdrop-blur-md shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-20 h-20 text-ipn">
                    <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
                <p class="py-5 text-lg font-extrabold text-ipn">AccesoUPIICSA</p>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('login') }}" class="w-[300px]">
                    @csrf
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-ipn">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="search" name="user" id="user" value="{{ old('user') }}" class="w-full py-3 pl-12 border-none rounded-md bg-inputField text-ipn placeholder:text-ipn placeholder:font-bold focus:ring-transparent" placeholder="Usuario" required>
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-ipn">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" class="w-full py-3 pl-12 border-none rounded-md bg-inputField text-ipn placeholder:text-ipn placeholder:font-bold focus:ring-transparent" placeholder="Contraseña" required>
                    </div>
                    <img src="/img/logo.png" alt="Logos">
                    <div class="relative mt-20">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-ipn">
                                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <button type="submit" class="w-full py-6 font-bold transition-all duration-500 ease-in-out transform bg-transparent border-b-2 border-transparent text-ipn hover:border-b-2 hover:border-ipn">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
