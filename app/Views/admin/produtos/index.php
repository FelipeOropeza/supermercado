<?php $this->layout('layouts/admin', ['title' => 'Gestão de Produtos - Admin']); ?>
<?php $role = session('user')['role'] ?? 'cliente'; ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Catálogo de Produtos</h2>
            <p class="text-gray-500 text-sm mt-1.5 font-medium">Gerencie o portfólio de vendas, estoque e imagem dos produtos ativos na loja.</p>
        </div>
        <button hx-get="<?= route('admin.produtos.create') ?>" hx-target="#modal-container" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md shadow-blue-100 transition-all duration-200 flex items-center gap-2 transform hover:-translate-y-0.5 active:scale-95">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Cadastrar Produto
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative z-10">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-white border-b border-gray-100 text-gray-400 text-[11px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="py-6 px-6 w-16 text-center">Img</th>
                        <th class="py-6 px-6">Produto & Status</th>
                        <th class="py-6 px-6">Categoria</th>
                        <th class="py-6 px-6 text-right">Estoque</th>
                        <th class="py-6 px-6 text-right">Preço Final</th>
                        <?php if ($role !== 'funcionario'): ?>
                            <th class="py-6 px-8 w-24 text-right">Ação</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    <?php if (empty($produtos)): ?>
                        <tr>
                            <td colspan="6" class="py-32 px-6 text-center">
                                <div class="max-w-md mx-auto flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-blue-200/50 shadow-inner">
                                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Catálogo vazio</h3>
                                    <p class="text-gray-500 text-sm mt-2 font-medium">Você não tem nenhum produto cadastrado no seu mercado ainda.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="py-5 px-6">
                                    <?php if ($produto->imagem_url): ?>
                                        <div class="w-12 h-12 rounded-xl border border-gray-100 overflow-hidden shadow-sm mx-auto">
                                            <img src="<?= storage_url($produto->imagem_url) ?>" alt="<?= htmlspecialchars($produto->nome) ?>" class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-12 h-12 mx-auto rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex flex-col gap-1.5">
                                        <div class="text-base font-extrabold text-gray-900 truncate max-w-xs transition-colors group-hover:text-blue-700">
                                            <?= htmlspecialchars($produto->nome) ?>
                                        </div>
                                        <div class="flex items-center">
                                            <?php if ($produto->ativo): ?>
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100 uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Produto Ativo
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1 text-[9px] font-black text-red-600 bg-red-50 px-2 py-0.5 rounded-full border border-red-100 uppercase tracking-widest" title="O produto está inativo. Não será vista pelo cliente na loja.">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Produto Oculto
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                     <span class="text-xs font-bold text-gray-500 bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">
                                        <?= htmlspecialchars($produto->categoria->nome ?? '-') ?>
                                     </span>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <div class="inline-flex flex-col items-end">
                                        <span class="text-base font-black <?= $produto->estoque > 0 ? 'text-gray-900' : 'text-red-500' ?>"><?= $produto->estoque ?></span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Unidades</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-right">
                                     <div class="flex items-center justify-end gap-1.5">
                                        <span class="text-gray-400 font-bold text-sm">R$</span>
                                        <span class="text-xl font-black text-green-600 tracking-tight leading-none drop-shadow-sm"><?= number_format($produto->preco, 2, ',', '.') ?></span>
                                    </div>
                                </td>
                                <?php if ($role !== 'funcionario'): ?>
                                    <td class="py-5 px-8 text-right">
                                        <div class="flex justify-end gap-2 items-center">
                                            <?php if (in_array($role, ['admin', 'gerente'])): ?>
                                                <button hx-get="<?= route('admin.produtos.edit', ['id' => $produto->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="text-gray-400 bg-white border border-gray-200 shadow-sm hover:text-blue-600 hover:border-blue-200 transition-all p-2.5 rounded-xl hover:bg-blue-50 active:scale-95" title="Editar Produto">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($role === 'admin'): ?>
                                                <form action="<?= route('admin.produtos.destroy', ['id' => $produto->id]) ?>" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente remover este produto?')">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="text-gray-400 bg-white border border-gray-200 shadow-sm hover:text-red-500 hover:border-red-200 transition-all p-2.5 rounded-xl hover:bg-red-50 active:scale-95 group/btn" title="Remover Produto">
                                                        <svg class="w-4 h-4 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Container HTMX -->
    <div id="modal-container"></div>

    <!-- Modais de Erro Direto na Página (Fallback pra não perder preenchimento em validation error) -->
    <?php if (!empty(errors())): ?>
        <?php if (empty(old('id'))): ?>
            <?= $this->include('admin/produtos/modals/create', ['categoriasList' => $categoriasList]) ?>
        <?php else: ?>
            <?php
            $produtoErro = (new \App\Services\ProdutoService())->getById(old('id'));
            if ($produtoErro) {
                echo $this->include('admin/produtos/modals/edit', ['produto' => $produtoErro]);
            }
            ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out forwards;
    }
</style>