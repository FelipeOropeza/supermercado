<!-- Navbar -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo e Links em Detalhe -->
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl">🛒</span>
                    <span class="font-bold text-xl text-green-700 tracking-tight">Supermercado</span>
                </a>

                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                    <a href="/" class="border-green-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Promoções (Folheto)
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Produtos
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Categorias
                    </a>
                </div>
            </div>

            <!-- Lado Direito: Ações / Login -->
            <div class="flex items-center space-x-4">
                <!-- Carrinho Ícone com Badge (Mock) -->
                <a href="#" class="relative p-2 text-gray-600 hover:text-green-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">0</span>
                </a>

                <!-- Autenticação Dinâmica -->
                <?php if (session()->has('user')): ?>
                    <div class="hidden sm:flex items-center space-x-3 border-l pl-4 border-gray-200">
                        <div class="text-sm font-medium text-gray-700">
                            Olá, <?= htmlspecialchars(session('user')['nome']) ?>
                        </div>
                        <a href="/dashboard" class="text-sm text-green-600 hover:text-green-800 font-semibold underline underline-offset-2">Minha Conta</a>
                    </div>
                <?php else: ?>
                    <div class="hidden sm:flex items-center space-x-2">
                        <a href="<?= route('login') ?>" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Entrar
                        </a>
                        <a href="<?= route('register') ?>" class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-md text-sm font-medium transition shadow-sm">Cadastre-se</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>