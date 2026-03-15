<?php $this->layout('layouts/main', ['title' => 'Detalhes do Pedido #' . str_pad((string)$pedido->id, 6, '0', STR_PAD_LEFT)]); ?>

<?php $this->section('content'); ?>
<main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <a href="/minha-conta/pedidos" class="text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-emerald-900 transition flex items-center gap-2 mb-4">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Voltar aos Pedidos
            </a>
            <h1 class="text-3xl font-black text-emerald-950 tracking-tight">Pedido #<?= str_pad((string)$pedido->id, 6, '0', STR_PAD_LEFT) ?></h1>
            <p class="text-gray-500 text-sm mt-1">Realizado em <?= date('d/m/Y \à\s H:i', strtotime($pedido->created_at)) ?></p>
        </div>
        <div class="text-right">
            <span class="px-4 py-2 bg-emerald-50 text-emerald-700 text-xs font-black uppercase tracking-widest rounded-full border border-emerald-100 italic">
                <?= htmlspecialchars($pedido->status) ?>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Itens do Pedido -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="text-xs font-black text-emerald-950 uppercase tracking-[0.2em]">Produtos do Pedido</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    <?php foreach ($pedido->itens as $item): 
                        $produto = $item->produto;
                    ?>
                        <div class="p-6 flex items-center gap-6">
                            <div class="w-20 h-20 bg-gray-50 rounded-xl border border-gray-100 flex-shrink-0 flex items-center justify-center p-2">
                                <?php if (!empty($produto->imagem_url)): ?>
                                    <img src="<?= storage_url($produto->imagem_url) ?>" alt="<?= htmlspecialchars($produto->nome) ?>" class="w-full h-full object-contain">
                                <?php else: ?>
                                    📦
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-sm font-bold text-emerald-950 mb-1"><?= htmlspecialchars($produto->nome) ?></h4>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest"><?= $item->quantidade ?> unidade(s) x R$ <?= number_format($item->preco_unitario_na_hora_da_compra, 2, ',', '.') ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-emerald-950">R$ <?= number_format($item->quantidade * $item->preco_unitario_na_hora_da_compra, 2, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="p-8 bg-gray-50/30 border-t border-gray-50">
                    <div class="flex flex-col gap-3 max-w-xs ml-auto">
                        <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-emerald-950">R$ <?= number_format($pedido->valor_total, 2, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <span>Taxa de Entrega</span>
                            <span class="text-emerald-950">R$ <?= number_format($pedido->taxa_entrega, 2, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-lg font-black text-emerald-950 pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span>R$ <?= number_format($pedido->valor_total + $pedido->taxa_entrega, 2, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Entrega e Pagamento -->
        <div class="space-y-6">
            <!-- Endereço -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <h3 class="text-xs font-black text-emerald-950 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Endereço de Entrega
                </h3>
                <?php if ($pedido->endereco): ?>
                    <p class="text-sm font-bold text-emerald-950 mb-1"><?= htmlspecialchars($pedido->endereco->rua) ?>, <?= htmlspecialchars($pedido->endereco->numero) ?></p>
                    <p class="text-xs text-gray-500 font-medium"><?= htmlspecialchars($pedido->endereco->bairro) ?></p>
                    <p class="text-xs text-gray-500 font-medium"><?= htmlspecialchars($pedido->endereco->cidade) ?> - <?= htmlspecialchars($pedido->endereco->estado) ?></p>
                    <p class="text-[10px] text-gray-400 font-bold tracking-widest mt-4 uppercase"><?= htmlspecialchars($pedido->endereco->cep) ?></p>
                <?php else: ?>
                    <p class="text-xs text-red-400 font-bold italic">Endereço não encontrado ou removido.</p>
                <?php endif; ?>
            </div>

            <!-- Pagamento -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <h3 class="text-xs font-black text-emerald-950 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    Pagamento
                </h3>
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-gray-50 rounded-lg text-emerald-900">
                        <?php if ($pedido->forma_pagamento_entrega === 'dinheiro'): ?>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <?php else: ?>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-emerald-950"><?= ucfirst($pedido->forma_pagamento_entrega) ?></p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Pagar na Entrega</p>
                    </div>
                </div>
                <?php if ($pedido->forma_pagamento_entrega === 'dinheiro' && $pedido->necessita_troco_para): ?>
                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <p class="text-[10px] text-emerald-800 font-black uppercase tracking-widest mb-1">Levar troco para</p>
                        <p class="text-sm font-black text-emerald-900">R$ <?= number_format((float)$pedido->necessita_troco_para, 2, ',', '.') ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Observações -->
            <?php if (!empty($pedido->observacoes)): ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                    <h3 class="text-xs font-black text-emerald-950 uppercase tracking-[0.2em] mb-4">Observações</h3>
                    <p class="text-sm text-gray-600 font-medium italic">"<?= htmlspecialchars($pedido->observacoes) ?>"</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $this->endSection(); ?>
