<?php $this->layout('layouts/main', ['title' => ($categoria->nome ?? 'Categoria') . ' | Supermercado']); ?>

<?php $this->section('content'); ?>
<div class="bg-white border-b border-gray-100 sticky top-0 z-10 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 overflow-x-auto no-scrollbar gap-8">
            <!-- Navegação Horizontal de Categorias (Pills) -->
            <div class="flex items-center gap-2 whitespace-nowrap py-2 flex-grow overflow-x-auto no-scrollbar">
                <a href="/produtos" class="px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600 hover:bg-gray-200">
                    Ver Todos
                </a>
                <?php foreach ($categorias as $cat): ?>
                    <a href="/categoria/<?= $cat->id ?>" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all <?= ($categoria->id == $cat->id) ? 'bg-green-600 text-white shadow-md shadow-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' ?>">
                        <?= e($cat->nome) ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <!-- Barra de Busca Interna -->
            <div class="hidden md:flex items-center flex-grow max-w-md mx-8">
                <form action="/busca" method="GET" class="w-full">
                    <div class="relative group">
                        <input type="text" name="q" placeholder="Pesquisar em <?= e($categoria->nome) ?>..."
                               class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-11 pr-4 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm shadow-inner">
                        <input type="hidden" name="categoria" value="<?= $categoria->id ?>">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-green-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Botão Filtrar Geral -->
            <a href="/busca" class="flex items-center gap-2 bg-green-50 text-green-700 hover:bg-green-100 px-4 py-2.5 rounded-xl transition font-bold text-sm border border-green-100 shrink-0 shadow-sm group">
                <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Busca & Filtros
            </a>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 min-h-[600px] p-6 sm:p-10">
        <!-- Cabeçalho da Categoria -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs text-gray-400">
                    <li><a href="/" class="hover:text-green-600 transition">Início</a></li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                            <span class="text-gray-500">Categorias</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                <?= e($categoria->nome ?? 'Produtos') ?>
            </h1>
            <p class="text-gray-500 mt-1"><?= count($produtos) ?> produtos encontrados nesta categoria</p>
        </div>
        
        <!-- Ordenação -->
        <form hx-get="/categoria/<?= $categoria->id ?>" hx-target="#grid-container" hx-trigger="change" class="flex items-center gap-3">
            <span class="text-sm text-gray-400 font-medium">Ordenar por:</span>
            <select name="order" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2 transition">
                <option value="mais_recentes" selected>Mais Recentes</option>
                <option value="preco_min">Menor Preço</option>
                <option value="preco_max">Maior Preço</option>
                <option value="nome">A-Z</option>
            </select>
        </form>
    </div>

    <!-- Grid de Produtos -->
    <div id="grid-container" class="animate-fade-in">
        <?php $this->include('components/produtos_grid', ['produtos' => $produtos]); ?>
    </div>
    </div>
</main>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
<?php $this->endSection(); ?>
