<?php $this->layout('layouts/main', ['title' => $title]); ?>

<?php $this->section('content'); ?>
<section class="bg-[#f9fafb] border-b border-gray-100 py-12 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-6xl font-extrabold text-emerald-950 tracking-[-0.03em] leading-none mb-4">
            Finalizar Compra
        </h1>
        <p class="text-gray-500 text-lg sm:text-xl max-w-2xl font-medium">Confirme os detalhes da sua entrega e finalize seu pedido.</p>
    </div>
</section>

<main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <form action="/checkout" method="POST">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Coluna da Esquerda: Dados de Entrega e Pagamento -->
            <div class="lg:col-span-8 space-y-16">
                
                <!-- Endereço de Entrega -->
                <section>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black text-emerald-950 tracking-tight">Endereço de Entrega</h2>
                        <a href="<?= route('enderecos.create') ?>" class="text-xs font-bold text-emerald-600 uppercase tracking-widest hover:underline">+ Novo Endereço</a>
                    </div>

                    <?php if (empty($enderecos)): ?>
                        <div class="p-8 border-2 border-dashed border-gray-100 rounded-sm text-center">
                            <p class="text-gray-400 font-medium mb-4">Você ainda não tem endereços cadastrados.</p>
                            <a href="<?= route('enderecos.create') ?>" class="inline-block py-3 px-6 bg-emerald-950 text-white text-[10px] font-black uppercase tracking-widest rounded-sm">Cadastrar Endereço</a>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach ($enderecos as $index => $end): ?>
                                <label class="relative block p-6 border-2 rounded-sm cursor-pointer transition-all duration-300 has-[:checked]:border-emerald-900 has-[:checked]:bg-emerald-50/30 border-gray-100 hover:border-gray-200 group">
                                    <input type="radio" name="endereco_id" value="<?= $end->id ?>" class="absolute opacity-0" <?= $index === 0 ? 'checked' : '' ?>>
                                    <div class="flex flex-col h-full">
                                        <div class="flex items-start justify-between mb-4">
                                            <span class="p-2 bg-gray-50 rounded-sm text-emerald-950 group-hover:bg-white transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </span>
                                            <div class="hidden group-has-[:checked]:block">
                                                <div class="w-5 h-5 bg-emerald-900 rounded-full flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="font-bold text-emerald-950 text-sm mb-1"><?= htmlspecialchars($end->rua) ?>, <?= htmlspecialchars($end->numero) ?></p>
                                        <p class="text-xs text-gray-500 font-medium"><?= htmlspecialchars($end->bairro) ?> - <?= htmlspecialchars($end->cidade) ?>/<?= htmlspecialchars($end->estado) ?></p>
                                        <p class="text-[10px] text-gray-400 mt-auto pt-4 font-bold tracking-widest"><?= htmlspecialchars($end->cep) ?></p>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Forma de Pagamento -->
                <section>
                    <h2 class="text-2xl font-black text-emerald-950 tracking-tight mb-8">Pagamento na Entrega</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative block p-6 border-2 rounded-sm cursor-pointer transition-all duration-300 has-[:checked]:border-emerald-900 has-[:checked]:bg-emerald-50/30 border-gray-100 hover:border-gray-200 group">
                            <input type="radio" name="pagamento" value="dinheiro" class="absolute opacity-0" checked onchange="toggleTroco(true)">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gray-50 rounded-sm text-emerald-950 group-hover:bg-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-emerald-950 text-sm">Dinheiro</p>
                                    <p class="text-xs text-gray-500 font-medium">Pague no ato da entrega</p>
                                </div>
                            </div>
                        </label>

                        <label class="relative block p-6 border-2 rounded-sm cursor-pointer transition-all duration-300 has-[:checked]:border-emerald-900 has-[:checked]:bg-emerald-50/30 border-gray-100 hover:border-gray-200 group">
                            <input type="radio" name="pagamento" value="maquininha" class="absolute opacity-0" onchange="toggleTroco(false)">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gray-50 rounded-sm text-emerald-950 group-hover:bg-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-emerald-950 text-sm">Cartão (Maquininha)</p>
                                    <p class="text-xs text-gray-500 font-medium">Débito ou Crédito</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Troco -->
                    <div id="troco-container" class="mt-8 transition-all duration-300 opacity-100 max-h-40 overflow-hidden">
                        <label class="block text-xs font-black text-emerald-950 uppercase tracking-widest mb-3">Precisa de troco para quanto?</label>
                        <div class="relative w-full sm:w-64">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">R$</span>
                            <input type="number" name="troco" step="0.01" class="w-full bg-gray-50 border border-gray-100 rounded-sm py-4 pl-12 pr-4 text-sm font-bold text-emerald-950 focus:ring-2 focus:ring-emerald-900/5 focus:border-emerald-900 outline-none transition-all" placeholder="0,00">
                        </div>
                    </div>
                </section>

                <!-- Observações -->
                <section>
                    <h2 class="text-2xl font-black text-emerald-950 tracking-tight mb-8">Observações</h2>
                    <textarea name="observacoes" rows="4" class="w-full bg-gray-50 border border-gray-100 rounded-sm p-6 text-sm font-medium text-emerald-950 focus:ring-2 focus:ring-emerald-900/5 focus:border-emerald-900 outline-none transition-all placeholder:text-gray-300" placeholder="Ex: Deixar na portaria, campainha estragada, etc..."></textarea>
                </section>
            </div>

            <!-- Coluna da Direita: Resumo do Pedido -->
            <div class="lg:col-span-4">
                <div class="sticky top-32">
                    <div class="bg-white border border-gray-100 rounded-sm p-8 shadow-2xl shadow-emerald-900/5">
                        <h3 class="text-lg font-black text-emerald-950 uppercase tracking-widest mb-8 border-b border-gray-50 pb-6">Resumo do Pedido</h3>
                        
                        <div class="space-y-6 mb-8 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                            <?php 
                            $totalItens = 0;
                            foreach ($itens as $item): 
                                $produto = $item->produto;
                                $precoAtivo = $produto->preco;
                                
                                // Busca promoção ativa
                                $today = date('Y-m-d H:i:s');
                                $db = \Core\Database\Connection::getInstance();
                                $stmt = $db->prepare("SELECT preco_promocional FROM promocoes WHERE produto_id = ? AND data_inicio <= ? AND data_fim >= ? LIMIT 1");
                                $stmt->execute([$produto->id, $today, $today]);
                                $promo = $stmt->fetch(\PDO::FETCH_ASSOC);
                                
                                if ($promo) {
                                    $precoAtivo = $promo['preco_promocional'];
                                }
                                $totalItens += $precoAtivo * $item->quantidade;
                            ?>
                                <div class="flex gap-4">
                                    <div class="w-12 h-12 bg-gray-50 rounded-sm border border-gray-100 flex-shrink-0 flex items-center justify-center p-1">
                                        <?php if (!empty($produto->imagem_url)): ?>
                                            <img src="<?= storage_url($produto->imagem_url) ?>" class="w-full h-full object-contain">
                                        <?php else: ?>
                                            📦
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-xs font-bold text-emerald-950 line-clamp-1"><?= htmlspecialchars($produto->nome) ?></p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?= $item->quantidade ?>x R$ <?= number_format($precoAtivo, 2, ',', '.') ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-black text-emerald-950">R$ <?= number_format($precoAtivo * $item->quantidade, 2, ',', '.') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="space-y-4 border-t border-gray-50 pt-8 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Subtotal</span>
                                <span class="text-sm font-bold text-emerald-950">R$ <?= number_format($totalItens, 2, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Taxa de Entrega</span>
                                <span class="text-sm font-bold text-emerald-900">R$ 5,00</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-emerald-950/5">
                                <span class="text-xs font-black text-emerald-950 uppercase tracking-[0.2em]">Total</span>
                                <span class="text-2xl font-black text-emerald-950 tracking-tighter">R$ <?= number_format($totalItens + 5.00, 2, ',', '.') ?></span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-5 bg-emerald-950 text-white text-xs font-black uppercase tracking-[0.2em] rounded-sm btn-premium shadow-xl shadow-emerald-900/10 transition-all active:scale-[0.98]">
                            Finalizar Pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    function toggleTroco(show) {
        const container = document.getElementById('troco-container');
        if (show) {
            container.style.maxHeight = '160px'; // Ajustado para ser maior que o conteúdo
            container.style.opacity = '1';
            container.style.marginTop = '2rem';
        } else {
            container.style.maxHeight = '0px';
            container.style.opacity = '0';
            container.style.marginTop = '0';
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #e2e8f0;
    }
</style>
<?php $this->endSection(); ?>
