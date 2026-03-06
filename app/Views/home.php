<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Supermercado Online') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

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
                            <a href="/login" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition">Entrar</a>
                            <a href="/register" class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-md text-sm font-medium transition shadow-sm">Cadastre-se</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner Principal -->
    <div class="bg-green-600 flex-grow-0">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:p-16 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between">
            <div class="w-full sm:w-1/2">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl tracking-tight mb-4">
                    O Seu Folheto <br>
                    <span class="text-green-200">100% Digital</span>
                </h1>
                <p class="mt-3 text-base text-green-100 sm:text-lg md:mt-5 md:max-w-xl">
                    Precisa das compras do mês mas está sem tempo? Navegue, adicione ao carrinho e nós levamos na sua porta. Promoções exclusivas toda semana!
                </p>
                <div class="mt-8 flex justify-center sm:justify-start gap-3">
                    <a href="#folheto" class="px-8 py-3 bg-white text-green-700 font-bold rounded-full shadow-lg hover:bg-gray-100 transition inline-flex items-center gap-2">
                        Ver Ofertas
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex w-full sm:w-1/3 justify-center">
                <div class="text-9xl transform rotate-12 drop-shadow-2xl">🛍️</div>
            </div>
        </div>
    </div>

    <!-- Seção: Produtos (Mockup Inicial) -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
        <h2 id="folheto" class="text-2xl font-bold flex items-center gap-2 text-gray-800 mb-8 border-b pb-4">
            🔥 Ofertas em Destaque
        </h2>

        <!-- Grid de Produtos Mockados -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-5xl">🍎</div>
                <div class="p-5">
                    <div class="uppercase tracking-wide text-xs text-green-600 font-semibold mb-1">Hortifruti</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">Maçã Fuji Nacional</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-gray-400 line-through text-sm">R$ 9,99/kg</span>
                        <span class="text-2xl font-extrabold text-red-600">R$ 7,50</span>
                    </div>
                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                            Faça login para comprar
                        </a>
                    <?php else: ?>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                            <span>Adicionar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-5xl">🥩</div>
                <div class="p-5">
                    <div class="uppercase tracking-wide text-xs text-green-600 font-semibold mb-1">Açougue</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">Picanha Bovina Fatiada</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-gray-400 line-through text-sm">R$ 89,90/kg</span>
                        <span class="text-2xl font-extrabold text-red-600">R$ 65,99</span>
                    </div>
                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                            Faça login para comprar
                        </a>
                    <?php else: ?>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                            <span>Adicionar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-5xl">🍞</div>
                <div class="p-5">
                    <div class="uppercase tracking-wide text-xs text-green-600 font-semibold mb-1">Padaria</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">Pão Francês Quentinho</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl font-extrabold text-gray-900">R$ 15,90<span class="text-base font-normal text-gray-500">/kg</span></span>
                    </div>
                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                            Faça login para comprar
                        </a>
                    <?php else: ?>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                            <span>Adicionar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            &copy; 2026 E-commerce Supermercado. Todos os direitos reservados.
        </div>
    </footer>
</body>

</html>