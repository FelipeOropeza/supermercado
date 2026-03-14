<?php $this->layout('layouts/main', ['title' => 'Nossos Produtos | Supermercado']); ?>

<?php $this->section('content'); ?>
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-center sm:text-left">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">
                Nossas <span class="text-green-600">Categorias</span>
            </h1>
            <p class="text-gray-500 mt-2 text-lg">Navegue por nosso catálogo completo.</p>
        </div>

        <!-- Barra de Busca (Nova localização) -->
        <div class="w-full max-w-md">
            <form action="/busca" method="GET" class="w-full">
                <div class="relative group">
                    <input type="text" name="q" placeholder="O que você procura hoje?"
                           class="w-full bg-white border border-transparent rounded-full py-4 pl-12 pr-6 focus:ring-2 focus:ring-green-500 shadow-sm transition-all text-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-green-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php foreach ($categorias as $cat): ?>
        <?php if (!empty($cat->produtos)): ?>
            <div id="categoria-section-<?= $cat->id ?>" class="mb-20 animate-fade-in">
                <div class="flex items-center justify-between mb-8 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-black text-gray-800 flex items-center gap-3">
                        <span class="w-1.5 h-7 bg-green-600 rounded-full"></span>
                        <?= e($cat->nome) ?>
                    </h2>
                    <a href="/categoria/<?= $cat->id ?>" class="group flex items-center gap-2 text-green-600 font-bold text-sm hover:text-green-700 transition">
                        Ver catálogo completo
                        <div class="bg-green-50 p-1 rounded-full group-hover:translate-x-1 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
                    <?php foreach ($cat->produtos as $produto): ?>
                        <?php $this->include('components/produto_card', ['produto' => $produto]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (empty($categorias)): ?>
        <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
            <div class="text-6xl mb-4">🛒</div>
            <h3 class="text-2xl font-bold text-gray-800">Estamos organizando as gôndolas</h3>
            <p class="text-gray-500 mt-2">Novos produtos estão chegando em breve!</p>
            <a href="/" class="mt-8 inline-block bg-green-600 text-white font-bold px-8 py-3 rounded-full hover:bg-green-700 transition">
                Voltar ao Início
            </a>
        </div>
    <?php endif; ?>
</main>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>
<?php $this->endSection(); ?>
