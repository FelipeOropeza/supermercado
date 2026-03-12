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

<!-- Seção: Produtos (Dinâmica via Promoções) -->
<main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
    <h2 id="folheto" class="text-2xl font-bold flex items-center gap-2 text-gray-800 mb-8 border-b pb-4">
        🔥 Ofertas em Destaque
    </h2>

    <!-- Grid de Produtos Reativo -->
    <?php include __DIR__ . '/components/promocoes_grid.php'; ?>
</main>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
</style>
<?php $this->endSection(); ?>