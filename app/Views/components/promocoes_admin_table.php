<?php 
$agora = new DateTime();
$role = $role ?? session('user')['role'] ?? 'cliente';
?>
<!-- Componente Reativo: promocoes_admin_table -->
<tbody id="comp-promocoes_admin_table" 
       hx-get="/admin/promocoes" 
       hx-trigger="refresh-promocoes_admin_table from:body" 
       hx-swap="outerHTML"
       class="divide-y divide-gray-50 text-gray-700 transition-all">
    
    <?php foreach ($promocoes as $promocao): 
        $inicio = new DateTime($promocao->data_inicio);
        $fim = new DateTime($promocao->data_fim);
        
        $status = 'Encerrada';
        $statusColor = 'bg-gray-300';
        $statusTextColor = 'text-gray-500';
        $statusPulse = '';

        if ($agora < $inicio) {
            $status = 'Agendada';
            $statusColor = 'bg-amber-400';
            $statusTextColor = 'text-amber-500';
        } elseif ($agora <= $fim) {
            $status = 'No Ar';
            $statusColor = 'bg-green-500';
            $statusTextColor = 'text-green-600';
            $statusPulse = 'animate-pulse';
        }

        $prodAtivo = $promocao->produto->ativo ?? false;
    ?>
    <tr class="hover:bg-blue-50/30 transition-colors group">
        <!-- Coluna 1: Home/Destaque -->
        <td class="py-5 px-6 text-center">
            <?php if ($promocao->destaque_folheto): ?>
            <div class="inline-flex items-center justify-center p-2.5 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-500 ring-1 ring-amber-200/50 shadow-sm transition-transform group-hover:scale-110" title="Item em Destaque (Capa do Folheto)">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
            <?php else: ?>
            <div class="inline-flex items-center justify-center p-2.5 text-gray-200 transition-colors group-hover:text-gray-300" title="Sem Destaque">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
            <?php endif; ?>
        </td>

        <!-- Coluna 2: Produto -->
        <td class="py-5 px-6">
            <div class="flex flex-col gap-1.5">
                <div class="text-base font-extrabold text-gray-900 truncate max-w-xs transition-colors group-hover:text-blue-700">
                    <?= htmlspecialchars($promocao->produto->nome) ?>
                </div>
                <div class="flex items-center">
                    <?php if ($prodAtivo): ?>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Produto Ativo
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-red-600 bg-red-50 px-2 py-0.5 rounded-full border border-red-100 uppercase tracking-widest" title="O produto está inativo. Oferta não será vista pelo cliente.">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Produto Oculto
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </td>

        <!-- Coluna 3: Status da Campanha -->
        <td class="py-5 px-6">
            <div class="flex flex-col gap-2">
                <div class="inline-flex items-center gap-2">
                    <div class="relative flex h-2.5 w-2.5">
                        <?php if ($statusPulse): ?>
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full <?= $statusColor ?> opacity-75"></span>
                        <?php endif; ?>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 <?= $statusColor ?>"></span>
                    </div>
                    <span class="text-[11px] font-black <?= $statusTextColor ?> uppercase tracking-widest"><?= $status ?></span>
                </div>
                <div class="text-xs font-semibold text-gray-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="bg-gray-50 px-2 py-0.5 rounded-md border border-gray-100"><?= $inicio->format('d/m/Y H:i') ?></span>
                    <span class="text-gray-300 font-normal">→</span> 
                    <span class="bg-gray-50 px-2 py-0.5 rounded-md border border-gray-100"><?= $fim->format('d/m/Y H:i') ?></span>
                </div>
            </div>
        </td>

        <!-- Coluna 4: Comparativo R$ -->
        <td class="py-5 px-6 text-right">
            <div class="flex flex-col justify-center items-end gap-0.5">
                <span class="text-xs font-bold text-red-400 line-through opacity-80 decoration-2">R$ <?= number_format($promocao->produto->preco, 2, ',', '.') ?></span>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    <span class="text-2xl font-black text-green-600 tracking-tight leading-none drop-shadow-sm">R$ <?= number_format($promocao->preco_promocional, 2, ',', '.') ?></span>
                </div>
            </div>
        </td>

        <!-- Coluna 5: Ações -->
        <td class="py-5 px-8 text-right">
            <?php if ($role === 'admin'): ?>
                <form action="<?= route('admin.promocoes.destroy', ['id' => $promocao->id]) ?>" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja remover esta promoção?')">
                    <?= csrf_field() ?>
                    <button type="submit" class="text-gray-400 bg-white border border-gray-200 shadow-sm hover:text-red-500 hover:border-red-200 transition-all p-2.5 rounded-xl hover:bg-red-50 active:scale-95 group/btn" title="Remover Promoção">
                        <svg class="w-4 h-4 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            <?php else: ?>
                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Apenas Leitura</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>

    <!-- EMPTY STATE PLACEHOLDER -->
    <?php if (empty($promocoes)): ?>
    <tr>
        <td colspan="5" class="py-32 px-6 text-center">
            <div class="max-w-md mx-auto flex flex-col items-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-blue-200/50 shadow-inner">
                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 tracking-tight">O folheto está vazio</h3>
                <p class="text-gray-500 text-sm mt-2 font-medium">Você ainda não programou nenhuma oferta especial para a loja. Que tal criar uma agora?</p>
            </div>
        </td>
    </tr>
    <?php endif; ?>
</tbody>

<!-- Antena Mercure Invisível (Padrão do Framework) -->
<?= mercure_listen('supermercado/promocoes', 'refresh-promocoes_admin_table') ?>
