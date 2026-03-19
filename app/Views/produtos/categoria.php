<?php $this->layout('layouts/main', ['title' => ($categoria->nome ?? 'Categoria') . ' | Supermercado']); ?>

<?php $this->section('content'); ?>
<div class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 md:py-0">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:h-20">
            <!-- Navegação Horizontal de Categorias (Carrossel com Setas) -->
            <div class="relative flex items-center group/carousel flex-grow overflow-hidden pr-4">
                <!-- Seta Esquerda -->
                <button onclick="scrollCats(-200)" class="absolute left-0 z-10 bg-white/90 backdrop-blur-sm border border-gray-100 p-2 rounded-full shadow-lg text-emerald-600 hover:bg-emerald-50 transition-all opacity-0 group-hover/carousel:opacity-100 hidden md:flex items-center justify-center -translate-x-1">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>

                <div id="cat-carousel" class="flex items-center gap-2 overflow-x-auto no-scrollbar py-2 px-1 scroll-smooth flex-grow">
                    <a href="/produtos" class="shrink-0 px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.15em] transition-all <?= !isset($categoria->id) ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-gray-100 text-gray-400 hover:bg-gray-200' ?>">
                        Ver Todos
                    </a>
                    <?php foreach ($categorias as $cat): ?>
                        <a href="/categoria/<?= $cat->id ?>" 
                           class="shrink-0 px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.15em] transition-all <?= (isset($categoria->id) && $categoria->id == $cat->id) ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-gray-100 text-gray-400 hover:bg-gray-200' ?>">
                            <?= e($cat->nome) ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- Seta Direita -->
                <button onclick="scrollCats(200)" class="absolute right-2 z-10 bg-white/90 backdrop-blur-sm border border-gray-100 p-2 rounded-full shadow-lg text-emerald-600 hover:bg-emerald-50 transition-all opacity-0 group-hover/carousel:opacity-100 hidden md:flex items-center justify-center translate-x-1">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
            </div>

            <script>
                function scrollCats(amount) {
                    const carousel = document.getElementById('cat-carousel');
                    carousel.scrollLeft += amount;
                }
            </script>
            
            <!-- Barra de Busca (Visível Mobile & Desktop) -->
            <div class="w-full md:w-64 shrink-0">
                <form action="/busca" method="GET" class="relative group">
                    <input type="text" name="q" placeholder="Buscar produtos..." 
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-3 pl-10 pr-4 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all text-xs font-semibold outline-none shadow-inner">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="3"></path></svg>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 md:py-10">
    <div class="bg-white rounded-2xl md:rounded-[2.5rem] shadow-sm border border-gray-100 min-h-[600px] p-5 md:p-10">
        <!-- Cabeçalho da Categoria -->
        <div class="mb-8 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        <li><a href="/" class="hover:text-emerald-600 transition">Início</a></li>
                        <li class="flex items-center">
                            <svg class="w-2.5 h-2.5 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                            <span>Categorias</span>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl md:text-5xl font-extrabold text-emerald-950 tracking-tight">
                    <?= e($categoria->nome ?? 'Produtos') ?>
                </h1>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm animate-pulse"></span>
                    <?= $paginacao['total'] ?> itens disponíveis
                </div>
            </div>
            
            <!-- Ordenação (Custom Dropdown) -->
            <div class="shrink-0 w-full md:w-auto" id="custom-order-select">
                <form hx-get="/categoria/<?= $categoria->id ?>" hx-target="#grid-container" hx-push-url="true" hx-trigger="change" class="flex flex-col gap-2 relative">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ml-1">Organizar por</label>
                    
                    <button type="button" 
                            onclick="document.getElementById('order-dropdown').classList.toggle('hidden')"
                            class="w-full md:w-64 bg-white border-2 border-gray-100 text-gray-950 text-sm font-bold rounded-2xl p-4 flex items-center justify-between transition-all shadow-sm hover:border-emerald-200 outline-none focus:ring-4 focus:ring-emerald-500/10">
                        <span id="order-label">Mais Recentes</span>
                        <svg class="w-5 h-5 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="order-dropdown" class="absolute top-[105%] left-0 w-full bg-white border border-gray-100 rounded-2xl shadow-2xl z-[100] hidden overflow-hidden animate-fade-in ring-1 ring-black/5">
                        <ul class="py-2">
                            <li><button type="button" onclick="selectOrder('mais_recentes', 'Mais Recentes')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-emerald-700 bg-emerald-50">Mais Recentes</button></li>
                            <li><button type="button" onclick="selectOrder('preco_min', 'Menor Preço')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">Menor Preço</button></li>
                            <li><button type="button" onclick="selectOrder('preco_max', 'Maior Preço')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">Maior Preço</button></li>
                            <li><button type="button" onclick="selectOrder('nome', 'A-Z')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">A-Z</button></li>
                        </ul>
                    </div>
                    <input type="hidden" name="order" id="order-input" value="mais_recentes">
                </form>
            </div>
        </div>

        <script>
            function selectOrder(val, label) {
                document.getElementById('order-input').value = val;
                document.getElementById('order-label').innerText = label;
                document.getElementById('order-dropdown').classList.add('hidden');
                htmx.trigger(document.getElementById('order-input').closest('form'), 'change');
            }
            window.addEventListener('click', (e) => {
                if (!document.getElementById('custom-order-select').contains(e.target)) {
                    document.getElementById('order-dropdown').classList.add('hidden');
                }
            });
        </script>

    <!-- Grid de Produtos -->
    <div id="grid-container" class="animate-fade-in">
        <?php $this->include('components/produtos_grid', [
            'produtos' => $produtos,
            'paginacao' => $paginacao
        ]); ?>
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
