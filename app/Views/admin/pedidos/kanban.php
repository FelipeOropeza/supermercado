<div class="flex h-full gap-6 min-w-max">
    <?php 
    $columns = [
        'aguardando' => ['title' => 'Aguardando', 'color' => 'blue'],
        'separacao'  => ['title' => 'Em Separação', 'color' => 'blue'],
        'saiu_entrega' => ['title' => 'Saiu para Entrega', 'color' => 'blue'],
        'entregue'   => ['title' => 'Entregue', 'color' => 'gray']
    ];
    ?>

    <?php foreach ($columns as $status => $info): ?>
        <div class="flex flex-col w-80 bg-gray-100/50 rounded-xl border border-gray-200">
            <!-- Column Title -->
            <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                <span class="text-sm font-bold text-gray-700 uppercase tracking-wider"><?= $info['title'] ?></span>
                <span class="bg-white border border-gray-200 text-gray-500 text-xs px-2 py-1 rounded-md font-bold">
                    <?= count(array_filter($pedidos, fn($p) => $p->status === $status)) ?>
                </span>
            </div>

            <!-- Cards Area -->
            <div class="flex-1 overflow-y-auto p-3 space-y-3">
                <?php foreach ($pedidos as $pedido): ?>
                    <?php if ($pedido->status === $status): ?>
                        <a href="/admin/pedidos/<?= $pedido->id ?>" class="block bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:border-blue-300 hover:shadow-md transition-all group">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[11px] font-bold text-blue-600">#<?= str_pad((string)$pedido->id, 5, '0', STR_PAD_LEFT) ?></span>
                                <span class="text-[10px] text-gray-400 font-medium"><?= date('H:i', strtotime($pedido->created_at)) ?></span>
                            </div>
                            
                            <h4 class="text-sm font-bold text-gray-800 truncate mb-1"><?= htmlspecialchars($pedido->usuario->nome ?? 'Cliente') ?></h4>
                            <p class="text-[11px] text-gray-500 truncate mb-3 italic"><?= htmlspecialchars($pedido->endereco->rua ?? 'Sem endereço') ?></p>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                                <span class="text-sm font-black text-gray-900">R$ <?= number_format($pedido->valor_total + $pedido->taxa_entrega, 2, ',', '.') ?></span>
                                
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
