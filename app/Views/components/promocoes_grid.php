<!-- Componente Reativo: promocoes_grid -->
<div id="comp-promocoes_grid" 
     hx-get="/" 
     hx-trigger="refresh-promocoes_grid from:body" 
     hx-swap="outerHTML"
     class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 transition-all">
    
    <?php if (empty($promocoes)): ?>
        <div class="col-span-full text-center py-12 animate-fade-in">
            <div class="text-6xl mb-4">⌛</div>
            <p class="text-gray-500 text-xl">Novas promoções estão sendo preparadas. Volte logo!</p>
        </div>
    <?php else: ?>
        <?php foreach ($promocoes as $promocao): ?>
            <?php $produto = $promocao->produto; ?>
            <div id="promo-<?= $promocao->id ?>" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group animate-fade-in">
                <div class="h-48 bg-gray-100 flex items-center justify-center text-5xl relative">
                    <?php if (!empty($produto->imagem_url)): ?>
                        <img src="<?= $produto->imagem_url ?>" alt="<?= htmlspecialchars($produto->nome) ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        📦
                    <?php endif; ?>
                    <div class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                        AO VIVO
                    </div>
                </div>
                <div class="p-5">
                    <div class="uppercase tracking-wide text-xs text-green-600 font-semibold mb-1">
                        <?= ($produto->categoria())->nome ?? 'Geral' ?>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate" title="<?= htmlspecialchars($produto->nome) ?>">
                        <?= htmlspecialchars($produto->nome) ?>
                    </h3>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-gray-400 line-through text-sm">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                        <span class="text-2xl font-extrabold text-red-600">R$ <?= number_format($promocao->preco_promocional, 2, ',', '.') ?></span>
                    </div>
                    
                    <?php if (!session()->has('user')): ?>
                        <a href="/login" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                            Faça login para comprar
                        </a>
                    <?php else: ?>
                        <button 
                            hx-post="/carrinho/add/<?= $produto->id ?>"
                            hx-swap="none"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2"
                        >
                            <span>Adicionar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Antena Mercure Invisível (Padrão do Framework) -->
<?= mercure_listen('supermercado/promocoes', 'refresh-promocoes_grid') ?>
