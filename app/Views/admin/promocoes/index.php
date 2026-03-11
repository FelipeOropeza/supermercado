<?php $this->layout('layouts/admin', ['title' => 'Gestão de Promoções - Admin']); ?>
<?php 
    $role = session('user')['role'] ?? 'cliente';
    if ($role === 'funcionario') { header('Location: /admin'); exit; }
?>

<div class="max-w-7xl mx-auto w-full">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Folheto de Promoções</h2>
            <p class="text-gray-500 text-sm mt-1.5 font-medium">Configure descontos agendados e produtos em destaque na vitrine principal.</p>
        </div>
        <?php if (in_array($role, ['admin', 'gerente'])): ?>
            <button onclick="document.getElementById('modal-nova-promocao').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md shadow-blue-100 transition-all duration-200 flex items-center gap-2 transform hover:-translate-y-0.5 active:scale-95">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Agendar Nova Oferta
            </button>
        <?php endif; ?>
    </div>

    <!-- Status Legend & Filters (Optional but nice for UX) -->
    <div class="flex flex-wrap gap-4 mb-6">
        <div class="flex items-center gap-6 text-xs font-bold text-gray-400 uppercase tracking-widest bg-white/50 px-4 py-2 rounded-lg border border-gray-100">
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-green-500 shadow-sm shadow-green-200"></span> No Ar</span>
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm shadow-amber-200"></span> Agendada</span>
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-gray-300 shadow-sm shadow-gray-100"></span> Encerrada</span>
        </div>
    </div>

    <!-- Main List (Table Design) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/80 border-b border-gray-100 text-gray-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-5 px-6 w-12 text-center text-[10px]">Posição</th>
                        <th class="py-5 px-6">Produto & Status</th>
                        <th class="py-5 px-6">Período de Validade</th>
                        <th class="py-5 px-6 text-right">Preços (Base → Promo)</th>
                        <th class="py-5 px-6 w-32 text-right">Operações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    <?php 
                    $agora = new DateTime();
                    foreach ($promocoes as $promocao): 
                        $inicio = new DateTime($promocao->data_inicio);
                        $fim = new DateTime($promocao->data_fim);
                        
                        $status = 'Encerrada';
                        $statusColor = 'bg-gray-300';
                        $statusShadow = 'shadow-gray-100';
                        $statusPulse = '';

                        // Compara os objetos diretamente (usa timestamps internos)
                        if ($agora < $inicio) {
                            $status = 'Agendada';
                            $statusColor = 'bg-amber-500';
                            $statusShadow = 'shadow-amber-200';
                        } elseif ($agora <= $fim) {
                            $status = 'No Ar';
                            $statusColor = 'bg-green-500';
                            $statusShadow = 'shadow-green-200';
                            $statusPulse = 'animate-pulse';
                        }
                    ?>
                    <tr class="hover:bg-blue-50/20 transition-colors group">
                        <td class="py-6 px-6 text-center">
                            <?php if ($promocao->destaque_folheto): ?>
                            <div class="inline-flex items-center justify-center p-2 rounded-lg bg-amber-50 text-amber-500 ring-1 ring-amber-100 shadow-sm" title="Item em Destaque (Capa do Folheto)">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <?php else: ?>
                            <div class="inline-flex items-center justify-center p-2 text-gray-200" title="Sem Destaque">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td class="py-6 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full <?= $statusColor ?> shadow-lg <?= $statusShadow ?> <?= $statusPulse ?>"></div>
                                <div>
                                    <div class="text-base font-bold text-gray-900"><?= $promocao->produto->nome ?></div>
                                    <div class="text-[10px] font-bold text-blue-600 uppercase tracking-tighter"><?= $status ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-6 font-medium text-gray-600 italic">
                            <?= $inicio->format('d/m/Y H:i') ?> <span class="mx-1 text-gray-300">até</span> <?= $fim->format('d/m/Y H:i') ?>
                        </td>
                        <td class="py-6 px-6 text-right">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-400 line-through opacity-70">R$ <?= number_format($promocao->produto->preco, 2, ',', '.') ?></span>
                                <span class="text-xl font-black text-green-600 tracking-tight leading-none">R$ <?= number_format($promocao->preco_promocional, 2, ',', '.') ?></span>
                            </div>
                        </td>
                        <td class="py-6 px-6 text-right">
                            <?php if ($role === 'admin'): ?>
                                <form action="<?= route('admin.promocoes.destroy', ['id' => $promocao->id]) ?>" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja remover esta promoção?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-all p-2 rounded-xl hover:bg-red-50" title="Remover Promoção">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-gray-300 uppercase italic">Somente Leitura</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <!-- EMPTY STATE PLACEHOLDER -->
                    <?php if (empty($promocoes)): ?>
                    <tr>
                        <td colspan="5" class="py-20 px-6 text-center">
                            <div class="max-w-xs mx-auto">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Sem ofertas ativas</h3>
                                <p class="text-gray-500 text-sm mt-1">Crie sua primeira promoção agendada clicando no botão acima.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Agendar Promoção -->
    <?= $this->include('admin/promocoes/modals/create') ?>
</div>

<style>
    @keyframes modalEntrance {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modal-entrance { 
        animation: modalEntrance 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
    }
</style>

