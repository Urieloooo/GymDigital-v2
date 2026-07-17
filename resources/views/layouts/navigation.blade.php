<nav x-data="{ open: false }" class="gym-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="GymDigital" class="h-8 w-auto">
                        <span class="font-bold text-lg text-blue-400">GymDigital</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('dashboard') ? 'text-blue-400 bg-blue-900' : 'text-gray-300 hover:text-white hover:bg-slate-700' }}">
                        Inicio
                    </a>
                    <a href="{{ route('clientes.index') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('clientes.*') ? 'text-blue-400 bg-blue-900' : 'text-gray-300 hover:text-white hover:bg-slate-700' }}">
                        Clientes
                    </a>
                    <a href="{{ route('pagos.index') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('pagos.*') ? 'text-blue-400 bg-blue-900' : 'text-gray-300 hover:text-white hover:bg-slate-700' }}">
                        Pagos
                    </a>
                    @if(auth()->user()->esDueno())
                    <a href="{{ route('historial.index') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('historial.*') ? 'text-blue-400 bg-blue-900' : 'text-gray-300 hover:text-white hover:bg-slate-700' }}">
                        Historial
                    </a>
                    <a href="{{ route('recepcionistas.index') }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('recepcionistas.*') ? 'text-blue-400 bg-blue-900' : 'text-gray-300 hover:text-white hover:bg-slate-700' }}">
                        Recepcionistas
                    </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-600 text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150" style="background-color: #16213e;">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="gym-dropdown rounded-md shadow-lg">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700 transition">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-slate-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: #16213e;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">Inicio</a>
            <a href="{{ route('clientes.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">Clientes</a>
            <a href="{{ route('pagos.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">Pagos</a>
            @if(auth()->user()->esDueno())
            <a href="{{ route('historial.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">Historial</a>
            <a href="{{ route('recepcionistas.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">Recepcionistas</a>
            @endif
        </div>
        <div class="pt-4 pb-1 border-t border-slate-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>