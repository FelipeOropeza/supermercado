<?php
/**
 * Componente: Produto Card
 * @var \App\Models\Produto $produto
 */
?>
<div id="produto-card-<?= $produto->id ?>" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full relative">
    
    <!-- Link para Detalhes (Overlay na Imagem) -->
    <div class="relative aspect-square bg-gray-50 overflow-hidden">
        <?php if (!empty($produto->imagem_url)): ?>
            <img src="<?= storage_url($produto->imagem_url) ?>" 
                 alt="<?= e($produto->nome) ?>" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-5xl opacity-20">📦</div>
        <?php endif; ?>

        <!-- Badges / Tags -->
        <?php if ($produto->preco_promocional ?? false): ?>
            <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-md shadow-sm uppercase tracking-tighter">
                Oferta
            </div>
        <?php endif; ?>

        <!-- Ação Rápida: Ver Detalhes (Aparece no Hover Desktop / Visível Mobile) -->
        <a href="/produto/<?= $produto->id ?>" 
           class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center group/btn">
            <div class="bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-lg transform scale-90 group-hover/btn:scale-100 transition-transform text-gray-700 hover:text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
        </a>
    </div>

    <!-- Conteúdo -->
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-sm font-bold text-gray-800 line-clamp-2 min-h-[40px] leading-tight hover:text-green-600 transition mb-1">
            <a href="/produto/<?= $produto->id ?>"><?= e($produto->nome) ?></a>
        </h3>
        
        <div class="mt-auto pt-2">
            <div class="flex flex-col">
                <?php if ($produto->preco_promocional ?? false): ?>
                    <span class="text-xs text-gray-400 line-through">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                    <span class="text-lg font-black text-red-600">R$ <?= number_format($produto->preco_promocional, 2, ',', '.') ?></span>
                <?php else: ?>
                    <span class="text-lg font-black text-gray-900">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Botão de Ação -->
        <div class="mt-4 flex gap-2">
            <!-- Botão Ver Detalhes (Apenas Mobile/Tablet para clareza, Desktop já tem o overlay) -->
            <a href="/produto/<?= $produto->id ?>" class="lg:hidden flex-1 border border-gray-200 text-gray-500 rounded-xl flex items-center justify-center hover:bg-gray-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </a>

            <?php if (!session()->has('user')): ?>
                <a href="/login" class="flex-[3] bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2 text-xs text-center leading-tight">
                    Login para comprar
                </a>
            <?php else: ?>
                <button 
                    hx-post="/carrinho/add/<?= $produto->id ?>"
                    hx-swap="none"
                    class="flex-[3] bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-4 rounded-xl transition shadow-sm hover:shadow-green-100 flex items-center justify-center gap-2 active:scale-95"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-sm">Adicionar</span>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
