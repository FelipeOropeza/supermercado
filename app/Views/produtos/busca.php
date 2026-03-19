<?php $this->layout('layouts/main', ['title' => $title]); ?>

<?php $this->section('content'); ?>
<div class="bg-white border-b border-gray-200 shadow-sm transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
            <div class="w-full text-center lg:text-left">
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Resultados para: <span class="text-green-600 block sm:inline">"<?= e($term ?: 'Todos os produtos') ?>"</span>
                </h1>
                <p class="text-sm text-gray-500 mt-2">Encontramos os melhores itens para você</p>
            </div>

            <!-- Barra de Busca (Nova pesquisa interna) -->
            <div class="w-full max-w-lg">
                <form action="/busca" method="GET" class="w-full">
                    <div class="relative group">
                        <input type="text" name="q" placeholder="Fazer nova busca..." value="<?= e($term) ?>"
                               class="w-full bg-gray-50 border border-gray-200 rounded-full py-3.5 md:py-4 pl-12 pr-6 focus:ring-2 focus:ring-green-500 focus:bg-white shadow-inner transition-all text-sm outline-none">
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
</div>

<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 md:py-10 flex flex-col lg:flex-row gap-6 md:gap-10 pb-20">
    <!-- Barra de Filtros (Otimizada para Mobile/Desktop) -->
    <aside class="w-full lg:w-72 flex-shrink-0 self-start z-20 mb-10 lg:mb-0">
        <div class="bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] shadow-sm border border-gray-100 ring-1 ring-black/5">
            <div class="flex items-center justify-between mb-4 md:mb-6 lg:hidden">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    Filtros Rápidos
                </h3>
            </div>
                        <form action="/busca" method="GET" hx-get="/busca" hx-target="#grid-container" hx-push-url="true" hx-trigger="change" 
                  class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 md:gap-6 lg:gap-8">
                <input type="hidden" name="q" value="<?= e($term) ?>">

                <!-- Categorias Custom Select -->
                <div class="space-y-2">
                    <label class="hidden lg:block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ml-1">Filtrar Categoria</label>
                    <div class="relative group" id="custom-select-container">
                        <button type="button" 
                                onclick="document.getElementById('cat-dropdown').classList.toggle('hidden')"
                                class="w-full bg-white border-2 border-gray-100 text-gray-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-600 flex items-center justify-between p-4 transition-all shadow-sm outline-none hover:border-emerald-200">
                            <span id="selected-label"><?= $categoriaSelecionada ? e($categorias[array_search($categoriaSelecionada, array_column($categorias, 'id'))]->nome) : 'Todas as Categorias' ?></span>
                            <svg class="w-5 h-5 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </button>
                        
                        <!-- Dropdown Menu (Forçado pra Baixo) -->
                        <div id="cat-dropdown" class="absolute top-[105%] left-0 w-full bg-white border border-gray-100 rounded-2xl shadow-2xl z-[100] hidden overflow-hidden animate-fade-in ring-1 ring-black/5">
                            <ul class="max-h-60 overflow-y-auto py-2">
                                <li>
                                    <button type="button" 
                                            onclick="selectCategory('', 'Todas as Categorias')"
                                            class="w-full text-left px-5 py-3 text-sm font-bold <?= !$categoriaSelecionada ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                                        Todas as Categorias
                                    </button>
                                </li>
                                <?php foreach ($categorias as $cat): ?>
                                    <li>
                                        <button type="button" 
                                                onclick="selectCategory('<?= $cat->id ?>', '<?= e($cat->nome) ?>')"
                                                class="w-full text-left px-5 py-3 text-sm font-bold <?= $categoriaSelecionada == $cat->id ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700 hover:bg-gray-50' ?>">
                                            <?= e($cat->nome) ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <input type="hidden" name="categoria" id="categoria-input" value="<?= $categoriaSelecionada ?>">
                    </div>
                </div>

                <script>
                    function selectCategory(id, name) {
                        document.getElementById('categoria-input').value = id;
                        document.getElementById('selected-label').innerText = name;
                        document.getElementById('cat-dropdown').classList.add('hidden');
                        
                        // Gatilho Manual para HTMX (já que o select original sumiu)
                        const form = document.getElementById('categoria-input').closest('form');
                        htmx.trigger(form, 'change');
                    }
                    
                    // Fechar dropdown ao clicar fora
                    window.addEventListener('click', (e) => {
                        if (!document.getElementById('custom-select-container').contains(e.target)) {
                            document.getElementById('cat-dropdown').classList.add('hidden');
                        }
                    });
                </script>

                <!-- Ordenação -->
                <!-- Ordenação (Custom Dropdown) -->
                <div class="space-y-2" id="custom-order-select">
                    <label class="hidden lg:block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Organizar por</label>
                    <div class="relative">
                        <button type="button" 
                                onclick="document.getElementById('order-dropdown').classList.toggle('hidden')"
                                class="w-full bg-white border-2 border-gray-100 text-emerald-950 text-sm font-bold rounded-2xl p-4 flex items-center justify-between transition-all shadow-sm hover:border-emerald-200 outline-none focus:ring-4 focus:ring-emerald-500/10">
                            <span id="order-label">Mais Recentes</span>
                            <svg class="w-5 h-5 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </button>
                        <div id="order-dropdown" class="absolute top-[105%] left-0 w-full bg-white border border-gray-100 rounded-2xl shadow-2xl z-[100] hidden overflow-hidden ring-1 ring-black/5">
                            <ul class="py-2 italic">
                                <li><button type="button" onclick="selectOrder('mais_recentes', 'Mais Recentes')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-emerald-700 bg-emerald-50">Mais Recentes</button></li>
                                <li><button type="button" onclick="selectOrder('preco_min', 'Menor Preço')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">Menor Preço</button></li>
                                <li><button type="button" onclick="selectOrder('preco_max', 'Maior Preço')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">Maior Preço</button></li>
                                <li><button type="button" onclick="selectOrder('nome', 'A-Z')" class="w-full text-left px-5 py-3.5 text-sm font-bold text-gray-700 hover:bg-gray-50">A-Z</button></li>
                            </ul>
                        </div>
                        <input type="hidden" name="order" id="order-input" value="mais_recentes">
                    </div>
                </div>

                <script>
                    function selectOrder(val, label) {
                        const input = document.getElementById('order-input');
                        input.value = val;
                        document.getElementById('order-label').innerText = label;
                        document.getElementById('order-dropdown').classList.add('hidden');
                        
                        // Dispara o HTMX manualmente já que o 'change from:select' não pegará o hidden input
                        htmx.trigger(input.closest('form'), 'change');
                    }
                    window.addEventListener('click', (e) => {
                        const menu = document.getElementById('order-dropdown');
                        const container = document.getElementById('custom-order-select');
                        if (container && !container.contains(e.target)) menu.classList.add('hidden');
                    });
                </script>
            </form>
        </div>
    </aside>

    <!-- Resultados -->
    <div class="flex-grow">
        <div id="grid-container" class="animate-fade-in bg-white p-5 md:p-8 rounded-2xl md:rounded-[2rem] shadow-sm border border-gray-100 min-h-[500px]">
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
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
<?php $this->endSection(); ?>
