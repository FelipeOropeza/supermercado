<!-- Componente Reativo: promocoes_grid (Redesenhado) -->
<div id="comp-promocoes_grid" 
     hx-get="/" 
     hx-trigger="refresh-promocoes_grid from:body" 
     hx-swap="outerHTML"
     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
    
    <?php if (empty($promocoes)): ?>
        <div class="col-span-full py-24 text-center border-2 border-dashed border-gray-100 rounded-sm">
            <div class="text-4xl mb-6 opacity-30">📦</div>
            <p class="text-gray-400 font-medium text-lg">Nenhuma oferta disponível no momento.</p>
            <p class="text-gray-400 text-sm mt-1">Estamos preparando novos preços especiais para você.</p>
        </div>
    <?php else: ?>
        <?php foreach ($promocoes as $promocao): ?>
            <?php $produto = $promocao->produto; ?>
            <div id="promo-<?= $promocao->id ?>" class="group flex flex-col h-full bg-white relative">
                <!-- Badge de Promoção -->
                <div class="absolute top-4 left-4 z-10">
                    <span class="bg-red-600 text-[10px] font-black text-white px-2 py-1 rounded-sm tracking-widest uppercase shadow-lg shadow-red-600/20">
                        OFF
                    </span>
                </div>

                <!-- Product Image -->
                <div class="relative aspect-square overflow-hidden bg-gray-50 border border-gray-100 rounded-sm mb-6">
                    <?php if (!empty($produto->imagem_url)): ?>
                        <img src="<?= $produto->imagem_url ?>" 
                             alt="<?= htmlspecialchars($produto->nome) ?>" 
                             class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 p-6">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">🛒</div>
                    <?php endif; ?>
                    
                    <!-- Quick Hover Action (Optional) -->
                    <div class="absolute inset-x-4 bottom-4 translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <!-- Botão Flutuante (Add ao Carrinho rápido no Hover no futuro) -->
                    </div>
                </div>

                <!-- Content -->
                <div class="flex flex-col flex-grow">
                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-2">
                         <?= ($produto->categoria())->nome ?? 'Geral' ?>
                    </p>
                    <h3 class="font-bold text-lg text-emerald-950 mb-3 line-clamp-2 leading-tight flex-grow" title="<?= htmlspecialchars($produto->nome) ?>">
                        <?= htmlspecialchars($produto->nome) ?>
                    </h3>
                    
                    <div class="flex flex-col mb-6">
                        <span class="text-xs text-gray-400 line-through mb-1 uppercase font-bold tracking-tighter">De: R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-xs font-bold text-red-600 uppercase">Por:</span>
                            <span class="text-2xl font-black text-emerald-950 tracking-tighter">R$ <?= number_format($promocao->preco_promocional, 2, ',', '.') ?></span>
                        </div>
                    </div>

                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="flex items-center justify-center w-full py-4 px-6 border border-gray-200 text-xs font-black text-emerald-900 uppercase tracking-widest hover:bg-emerald-50 transition-colors rounded-sm">
                            Entrar para Comprar
                        </a>
                    <?php else: ?>
                        <button 
                            hx-post="/carrinho/add/<?= $produto->id ?>"
                            hx-swap="none"
                            class="group/btn relative flex items-center justify-center w-full py-4 px-6 bg-emerald-950 text-white text-[11px] font-black uppercase tracking-[0.2em] overflow-hidden rounded-sm btn-premium"
                        >
                            <span class="relative z-10 flex items-center gap-2">
                                Adicionar
                                <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Antena Mercure Invisível -->
<?= mercure_listen('supermercado/promocoes', 'refresh-promocoes_grid') ?>
