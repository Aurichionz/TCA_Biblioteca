<nav class="bg-pink-50 border-b border-pink-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('livros.index') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-pink-600" />
                </a>
            </div>

            <!-- Menu desktop -->
            <div class="hidden sm:flex justify-center flex-1 items-center">
                <ul class="flex space-x-6">
                    <li>
                        <a href="{{ route('livros.index') }}" 
                           class="{{ request()->routeIs('livros.index') ? 'text-pink-600 border-b-2 border-pink-400 pb-2 font-semibold' : 'text-pink-400 border-b-2 border-transparent pb-2' }} hover:text-pink-800 transition">
                            Livros
                        </a>
                    </li>

                    @auth
                        @if(!(Auth::user()->is_admin ?? false))
                            <li>
                                <a href="{{ route('emprestimos.index') }}" 
                                   class="{{ request()->routeIs('emprestimos.index') ? 'text-pink-600 border-b-2 border-pink-400 pb-2 font-semibold' : 'text-pink-400 border-b-2 border-transparent pb-2' }} hover:text-pink-800 transition">
                                    Meus Empréstimos
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('categorias.index') }}" 
                                   class="{{ request()->routeIs('categorias.*') ? 'text-pink-600 border-b-2 border-pink-400 pb-2 font-semibold' : 'text-pink-400 border-b-2 border-transparent pb-2' }} hover:text-pink-800 transition">
                                    Categorias
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('autores.index') }}" 
                                   class="{{ request()->routeIs('autores.*') ? 'text-pink-600 border-b-2 border-pink-400 pb-2 font-semibold' : 'text-pink-400 border-b-2 border-transparent pb-2' }} hover:text-pink-800 transition">
                                    Autores
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('emprestimos.admin') }}" 
                                   class="{{ request()->routeIs('emprestimos.admin') ? 'text-pink-600 border-b-2 border-pink-400 pb-2 font-semibold' : 'text-pink-400 border-b-2 border-transparent pb-2' }} hover:text-pink-800 transition">
                                    Controle de Empréstimos
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>

            <!-- Login / Perfil -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-pink-600 hover:text-pink-800 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.292 7.293a1 1 0 011.414 0L10 10.586l3.292-3.293a1 1
                                        0 111.414 1.414l-4 4a1 1 0
                                        01-1.414 0l-4-4a1 1 0
                                        010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-pink-600 hover:text-pink-800">
                                Perfil
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-pink-600 hover:text-pink-800">
                                    Sair
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-pink-600 hover:text-pink-800 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-pink-600 hover:text-pink-800">Criar Conta</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
