<?php $this->layout('layouts/main', ['title' => 'Início | Supermercado']); ?>

<?php $this->section('content'); ?>
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
<?php $this->endSection(); ?>