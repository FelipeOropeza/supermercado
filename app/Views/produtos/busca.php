<?php $this->layout('layouts/main', ['title' => $title]); ?>

<?php $this->section('content'); ?>
<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">
            Resultados para: <span class="text-green-600">"<?= e($term ?: 'Todos os produtos') ?>"</span>
        </h1>

        <!-- Barra de Busca (Nova pesquisa interna) -->
        <div class="w-full max-w-md">
            <form action="/busca" method="GET" class="w-full">
                <div class="relative group">
                    <input type="text" name="q" placeholder="Fazer nova busca..." value="<?= e($term) ?>"
                           class="w-full bg-white border border-gray-200 rounded-full py-3.5 pl-12 pr-6 focus:ring-2 focus:ring-green-500 shadow-sm transition-all text-sm">
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

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 flex flex-col lg:flex-row gap-8">
    <!-- Sidebar de Filtros -->
    <aside class="w-full lg:w-64 flex-shrink-0 bg-white p-6 rounded-3xl shadow-sm border border-gray-100 self-start">
        <form hx-get="/busca" hx-target="#grid-container" hx-trigger="change from:select" class="space-y-8">
            <input type="hidden" name="q" value="<?= e($term) ?>">

            <!-- Categorias -->
            <div>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Filtrar por Categoria</h3>
                <div class="space-y-2">
                    <a href="/busca?q=<?= urlencode((string)$term) ?>" 
                       class="block px-3 py-2 rounded-lg text-sm transition-colors <?= !$categoriaSelecionada ? 'bg-green-600 text-white font-bold' : 'text-gray-600 hover:bg-gray-100' ?>">
                        Todas as Categorias
                    </a>
                    <?php foreach ($categorias as $cat): ?>
                        <a href="/busca?q=<?= urlencode((string)$term) ?>&categoria=<?= $cat->id ?>" 
                           class="block px-3 py-2 rounded-lg text-sm transition-colors <?= $categoriaSelecionada == $cat->id ? 'bg-green-600 text-white font-bold' : 'text-gray-600 hover:bg-gray-100' ?>">
                            <?= e($cat->nome) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Ordenação -->
            <div>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Ordenar por</h3>
                <select name="order" class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-3 transition shadow-sm">
                    <option value="mais_recentes" selected>Mais Recentes</option>
                    <option value="preco_min">Menor Preço</option>
                    <option value="preco_max">Maior Preço</option>
                    <option value="nome">A-Z</option>
                </select>
            </div>
        </form>
    </aside>

    <!-- Resultados -->
    <div class="flex-grow bg-white p-6 sm:p-10 rounded-3xl shadow-sm border border-gray-100 min-h-[600px]">
        <div id="grid-container" class="animate-fade-in">
            <?php $this->include('components/produtos_grid', ['produtos' => $produtos]); ?>
        </div>
    </div>
</main>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
<?php $this->endSection(); ?>
