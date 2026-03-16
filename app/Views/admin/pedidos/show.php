<?php $this->layout('layouts/admin', ['title' => 'Pedido #' . $pedido->id, 'hideSidebar' => true]); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Breadcrumb / Header -->
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shrink-0">
        <div class="flex items-center gap-4">
            <a href="/admin/pedidos" class="flex items-center gap-2 text-blue-600 hover:underline text-sm font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar ao Kanban
            </a>
            <div class="h-4 w-px bg-gray-300"></div>
            <h1 class="text-base font-bold text-gray-900">Pedido #<?= str_pad((string)$pedido->id, 5, '0', STR_PAD_LEFT) ?></h1>
        </div>

        <?php
        $statusLabels = [
            'aguardando' => ['label' => 'Aguardando Aprovação', 'class' => 'bg-amber-100 text-amber-700'],
            'separacao'  => ['label' => 'Em Separação', 'class' => 'bg-blue-100 text-blue-700'],
            'saiu_entrega' => ['label' => 'Saiu para Entrega', 'class' => 'bg-indigo-100 text-indigo-700'],
            'entregue'   => ['label' => 'Entregue', 'class' => 'bg-emerald-100 text-emerald-700'],
            'cancelado'  => ['label' => 'Cancelado', 'class' => 'bg-red-100 text-red-700'],
        ];
        $st = $statusLabels[$pedido->status] ?? ['label' => $pedido->status, 'class' => 'bg-gray-100 text-gray-700'];
        ?>
        <div class="px-3 py-1 rounded-full text-xs font-bold <?= $st['class'] ?>">
            <?= $st['label'] ?>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto w-full p-6 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Info (Items) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-200 bg-gray-50/50">
                        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Itens do Pedido</h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <?php foreach ($pedido->itens as $item): ?>
                            <div class="p-4 flex items-center gap-4">
                                <?php if ($item->produto->imagem): ?>
                                    <img src="<?= $item->produto->imagem ?>" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100">
                                        <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-gray-900"><?= htmlspecialchars($item->produto->nome) ?></h4>
                                    <p class="text-[11px] text-gray-500 italic">Preço Unit: R$ <?= number_format($item->preco_unitario_na_hora_da_compra, 2, ',', '.') ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-bold text-gray-900">x<?= $item->quantidade ?></span>
                                    <p class="text-sm font-black text-blue-600">R$ <?= number_format($item->quantidade * $item->preco_unitario_na_hora_da_compra, 2, ',', '.') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Totals -->
                    <div class="p-6 bg-gray-50 border-t border-gray-100 space-y-2">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Subtotal</span>
                            <span>R$ <?= number_format($pedido->valor_total, 2, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Taxa de Entrega</span>
                            <span>R$ <?= number_format($pedido->taxa_entrega, 2, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-lg font-black text-gray-900 pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span>R$ <?= number_format($pedido->valor_total + $pedido->taxa_entrega, 2, ',', '.') ?></span>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <?php if ($pedido->observacoes): ?>
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                        <h3 class="text-xs font-bold text-blue-800 uppercase mb-2">Observações</h3>
                        <p class="text-sm text-blue-700 italic">"<?= htmlspecialchars($pedido->observacoes) ?>"</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Info (Client/Status) -->
            <div class="space-y-6">
                <!-- Client Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-200 bg-gray-50/50">
                        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Cliente</h2>
                    </div>
                    <div class="p-4">
                        <p class="font-bold text-gray-900"><?= htmlspecialchars($pedido->usuario->nome ?? 'Cliente Analfabeto') ?></p>
                        <p class="text-xs text-gray-500"><?= htmlspecialchars($pedido->usuario->email ?? 'Sem e-mail') ?></p>
                        <p class="text-xs text-gray-500 mt-1">CPF: <?= htmlspecialchars($pedido->usuario->cpf ?? 'N/A') ?></p>
                    </div>
                </div>

                <!-- Logistics Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-200 bg-gray-50/50">
                        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Entrega & Pagamento</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Endereço</p>
                            <p class="text-sm text-gray-900"><?= htmlspecialchars($pedido->endereco->rua ?? '-') ?>, <?= htmlspecialchars($pedido->endereco->numero ?? '-') ?></p>
                            <p class="text-xs text-gray-500"><?= htmlspecialchars($pedido->endereco->bairro ?? '-') ?> • <?= htmlspecialchars($pedido->endereco->cep ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Pagamento</p>
                            <p class="text-sm font-bold text-blue-600 uppercase italic"><?= e($pedido->forma_pagamento_entrega) ?></p>
                            <?php if ($pedido->forma_pagamento_entrega === 'dinheiro' && $pedido->necessita_troco_para): ?>
                                <p class="text-xs text-gray-600 mt-1 font-bold bg-amber-50 p-2 border border-amber-100 rounded">
                                    Troco para: R$ <?= number_format($pedido->necessita_troco_para, 2, ',', '.') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 space-y-3">
                    <?php if ($pedido->status === 'aguardando'): ?>
                        <form action="/admin/pedidos/<?= $pedido->id ?>/status" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="separacao">
                            <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">Aprovar Pedido</button>
                        </form>
                    <?php elseif ($pedido->status === 'separacao'): ?>
                        <form action="/admin/pedidos/<?= $pedido->id ?>/status" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="saiu_entrega">
                            <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">Despachar Pedido</button>
                        </form>
                    <?php elseif ($pedido->status === 'saiu_entrega'): ?>
                        <form action="/admin/pedidos/<?= $pedido->id ?>/status" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="entregue">
                            <button class="w-full bg-emerald-600 text-white py-3 rounded-lg font-bold hover:bg-emerald-700 transition">Marcar como Entregue</button>
                        </form>
                    <?php elseif ($pedido->status === 'entregue'): ?>
                        <form action="/admin/pedidos/<?= $pedido->id ?>/status" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="cancelado">
                            <button class="w-full bg-red-600 text-white py-3 rounded-lg font-bold hover:bg-red-700 transition">Cancelar Pedido</button>
                        </form>
                    <?php endif; ?>

                    <?php if ($pedido->status !== 'cancelado' && $pedido->status !== 'entregue'): ?>
                        <form action="/admin/pedidos/<?= $pedido->id ?>/status" method="POST" onsubmit="return confirm('Cancelar este pedido?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="cancelado">
                            <button class="w-full border border-red-200 text-red-500 py-2 rounded-lg text-sm font-bold hover:bg-red-50 transition">Cancelar Pedido</button>
                        </form>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>