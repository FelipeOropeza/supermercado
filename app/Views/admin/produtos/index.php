<?php $this->layout('layouts/admin', ['title' => 'Gestão de Produtos - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Produtos</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie os itens do catálogo, imagens e estoque.</p>
        </div>
        <button hx-get="<?= route('admin.produtos.create') ?>" hx-target="#modal-container" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
            <span>+</span> Novo Produto
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600">
                    <tr>
                        <th class="py-4 px-6 font-semibold w-16">Img</th>
                        <th class="py-4 px-6 font-semibold">Produto</th>
                        <th class="py-4 px-6 font-semibold">Categoria</th>
                        <th class="py-4 px-6 font-semibold text-right">Estoque</th>
                        <th class="py-4 px-6 font-semibold text-right">Preço</th>
                        <th class="py-4 px-6 font-semibold w-32 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <?php if (empty($produtos)): ?>
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-500 font-medium">Nenhum produto cadastrado</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <?php if ($produto->imagem_url): ?>
                                        <div class="w-10 h-10 rounded-md border border-gray-200 overflow-hidden">
                                            <img src="<?= storage_url($produto->imagem_url) ?>" alt="<?= htmlspecialchars($produto->nome) ?>" class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-md bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-base font-medium">
                                    <div class="flex items-center gap-2">
                                        <?= htmlspecialchars($produto->nome) ?>
                                        <?php if (!$produto->ativo): ?>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-500">Inativo</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                                    <?= htmlspecialchars($produto->categoria->nome ?? '-') ?>
                                </td>
                                <td class="py-4 px-6 text-right font-medium <?= $produto->estoque > 0 ? 'text-gray-900' : 'text-red-500' ?>">
                                    <?= $produto->estoque ?> un.
                                </td>
                                <td class="py-4 px-6 text-right font-medium text-gray-900">
                                    R$ <?= number_format($produto->preco, 2, ',', '.') ?>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex justify-end gap-2 items-center">
                                        <button hx-get="<?= route('admin.produtos.edit', ['id' => $produto->id]) ?>" hx-target="#modal-container" class="text-blue-600 hover:text-blue-800 font-medium p-1">Editar</button>
                                        <form action="<?= route('admin.produtos.destroy', ['id' => $produto->id]) ?>" method="POST" onsubmit="return confirm('Deseja realmente remover?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium p-1">Remover</button>
                                        </form>
                                    </div>
                                </td>
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