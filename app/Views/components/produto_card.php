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
    <div class="p-5 flex flex-col flex-grow">
        <h3 class="text-base md:text-lg font-extrabold text-gray-900 line-clamp-2 min-h-[48px] leading-tight hover:text-emerald-700 transition mb-2">
            <a href="/produto/<?= $produto->id ?>"><?= e($produto->nome) ?></a>
        </h3>
        
        <div class="mt-auto pt-4 border-t border-gray-50">
            <div class="flex flex-col">
                <?php if ($produto->preco_promocional ?? false): ?>
                    <span class="text-xs text-gray-400 line-through font-medium">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                    <span class="text-xl md:text-2xl font-black text-red-600 tracking-tight">R$ <?= number_format($produto->preco_promocional, 2, ',', '.') ?></span>
                <?php else: ?>
                    <span class="text-xl md:text-2xl font-black text-emerald-950 tracking-tight">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Botão de Ação -->
        <div class="mt-auto pt-5">
            <?php if (!session()->has('user')): ?>
                <a href="/login" class="w-full bg-emerald-50 text-emerald-950 border border-emerald-200 font-extrabold py-3.5 px-4 rounded-xl transition-all flex items-center justify-center gap-2 text-xs uppercase tracking-widest leading-none hover:bg-emerald-100">
                    Entrar para Comprar
                </a>
            <?php else: ?>
                <button 
                    hx-post="/carrinho/add/<?= $produto->id ?>"
                    hx-swap="none"
                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-black py-3.5 px-4 rounded-xl transition-all shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 active:scale-95 text-xs uppercase tracking-widest"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Comprar</span>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
