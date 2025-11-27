<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('livros.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- LINKS DO MENU -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <!-- TODOS VEEM LIVROS -->
                    <x-nav-link :href="route('livros.index')" :active="request()->routeIs('livros.index')">
                        {{ __('Livros') }}
                    </x-nav-link>

                    <!-- USUÁRIO NORMAL VE MEUS EMPRÉSTIMOS -->
                    @auth
                        @if(!(Auth::user()->is_admin ?? false))
                            <x-nav-link :href="route('emprestimos.index')" :active="request()->routeIs('emprestimos.index')">
                                {{ __('Meus Empréstimos') }}
                            </x-nav-link>
                        @endif

                        <!-- ADMIN VE CATEGORIAS + AUTORES + CONTROLE -->
                        @if(Auth::user()->is_admin)
                            <x-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.*')">
                                {{ __('Categorias') }}
                            </x-nav-link>

                            <x-nav-link :href="route('autores.index')" :active="request()->routeIs('autores.*')">
                                {{ __('Autores') }}
                            </x-nav-link>

                            <x-nav-link :href="route('emprestimos.admin')" :active="request()->routeIs('emprestimos.admin')">
                                {{ __('Controle de Empréstimos') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- DROPDOWN DE LOGIN / PERFIL -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
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
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login')">{{ __('Login') }}</x-nav-link>
                    <x-nav-link :href="route('register')">{{ __('Criar Conta') }}</x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
