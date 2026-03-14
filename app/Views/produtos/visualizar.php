<?php $this->layout('layouts/main', ['title' => $title]); ?>

<?php $this->section('content'); ?>
<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-500">
            <li class="inline-flex items-center">
                <a href="/" class="hover:text-green-600 transition">Início</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="/categoria/<?= $produto->categoria_id ?>" class="hover:text-green-600 transition"><?= e($produto->categoria->nome) ?></a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-gray-900 font-bold line-clamp-1"><?= e($produto->nome) ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Coluna da Imagem -->
            <div class="p-4 sm:p-8 lg:p-12 bg-gray-50/50">
                <div class="relative aspect-square rounded-[2rem] bg-white shadow-inner overflow-hidden flex items-center justify-center p-8 group">
                    <?php if (!empty($produto->imagem_url)): ?>
                        <img src="<?= storage_url($produto->imagem_url) ?>" 
                             alt="<?= e($produto->nome) ?>" 
                             class="max-w-full max-h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-700">
                    <?php else: ?>
                        <div class="text-9xl opacity-10">📦</div>
                    <?php endif; ?>

                    <?php if ($produto->preco_promocional ?? false): ?>
                        <div class="absolute top-8 left-8 bg-red-600 text-white font-black px-6 py-2 rounded-2xl shadow-lg uppercase tracking-wider text-sm">
                            -<?= $produto->porcentagem_desconto ?>% de Desconto
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Coluna da Informação -->
            <div class="p-8 sm:p-12 lg:p-16 flex flex-col">
                <div class="mb-auto">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-bold uppercase tracking-widest mb-4">
                        <?= e($produto->categoria->nome) ?>
                    </span>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 leading-tight mb-6">
                        <?= e($produto->nome) ?>
                    </h1>

                    <div class="flex items-center gap-4 mb-8">
                        <?php if ($produto->preco_promocional ?? false): ?>
                            <div class="flex flex-col">
                                <span class="text-lg text-gray-400 line-through">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                                <span class="text-4xl sm:text-5xl font-black text-red-600">R$ <?= number_format($produto->preco_promocional, 2, ',', '.') ?></span>
                            </div>
                        <?php else: ?>
                            <span class="text-4xl sm:text-5xl font-black text-gray-900">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="prose prose-sm prose-gray max-w-none text-gray-500 mb-10">
                        <p class="text-lg leading-relaxed italic">
                            <?= e($produto->descricao ?: 'Infelizmente este produto ainda não possui uma descrição detalhada, mas garantimos a melhor qualidade para sua casa.') ?>
                        </p>
                    </div>

                    <!-- Estoque / Info -->
                    <div class="flex items-center gap-6 mb-12 py-6 border-y border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold leading-none mb-1">Disponibilidade</p>
                                <p class="text-sm font-bold text-gray-800">Em Estoque</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold leading-none mb-1">Qualidade</p>
                                <p class="text-sm font-bold text-gray-800">Verificado</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ações de Compra -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="flex-1 bg-gray-900 hover:bg-black text-white font-black py-5 px-8 rounded-2xl transition-all shadow-xl shadow-gray-200 flex items-center justify-center gap-3 active:scale-[0.98]">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            Fazer Login para Comprar
                        </a>
                    <?php else: ?>
                        <div class="flex items-center bg-gray-100 rounded-2xl p-1 shrink-0">
                            <button class="w-14 h-14 flex items-center justify-center text-gray-400 hover:text-green-600 transition" onclick="updateQty(-1)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <input type="number" id="produto-qty" value="1" min="1" class="w-12 bg-transparent text-center font-black text-xl border-none focus:ring-0 text-gray-800 pointer-events-none">
                            <button class="w-14 h-14 flex items-center justify-center text-gray-400 hover:text-green-600 transition" onclick="updateQty(1)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <button 
                            hx-post="/carrinho/add/<?= $produto->id ?>"
                            hx-vals='js:{quantidade: document.getElementById("produto-qty").value}'
                            hx-swap="none"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-black py-5 px-8 rounded-2xl transition-all shadow-xl shadow-green-100 flex items-center justify-center gap-3 active:scale-[0.98] group"
                        >
                            <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Adicionar ao Carrinho
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Sugestões -->
    <?php if (!empty($sugestoes)): ?>
        <section class="mt-24">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                    Quem viu este, também <span class="text-green-600">gostou...</span>
                </h2>
                <a href="/categoria/<?= $produto->categoria_id ?>" class="text-green-600 font-bold hover:underline">Ver tudo de <?= e($produto->categoria->nome) ?></a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <?php foreach ($sugestoes as $sugestao): ?>
                    <?php $this->include('components/produto_card', ['produto' => $sugestao]); ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<script>
function updateQty(delta) {
    const input = document.getElementById('produto-qty');
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    input.value = val;
}
</script>
<?php $this->endSection(); ?>
