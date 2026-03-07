<?php $this->layout('layouts/admin', ['title' => 'Gestão de Categorias - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Categorias</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie os corredores do seu supermercado online.</p>
        </div>
        <button hx-get="<?= route('admin.categorias.create') ?>" hx-target="#modal-container" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
            <span>+</span> Nova Categoria
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600">
                    <tr>
                        <th class="py-4 px-6 font-semibold w-24">ID</th>
                        <th class="py-4 px-6 font-semibold">Nome da Categoria</th>
                        <th class="py-4 px-6 font-semibold w-32">Descrição</th>
                        <th class="py-4 px-6 font-semibold w-32 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <?php if (empty($categorias)): ?>
                        <tr>
                            <td class="py-4 px-6 text-gray-500 font-medium">Nenhuma categoria encontrada</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 text-gray-500 font-medium"><?= $categoria->id ?></td>
                                <td class="py-4 px-6 text-base font-medium"><?= $categoria->nome ?></td>
                                <td class="py-4 px-6 text-base font-medium"><?= $categoria->descricao ?></td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button hx-get="<?= route('admin.categorias.edit', ['id' => $categoria->id]) ?>" hx-target="#modal-container" class="text-blue-600 hover:text-blue-800 font-medium p-1">Editar</button>
                                        <form action="<?= route('admin.categorias.destroy', ['id' => $categoria->id]) ?>" method="POST">
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
    
    <!-- Modais de Erro Direto na Página -->
    <?php if (!empty(errors())): ?>
        <?php if (empty(old('id'))): ?>
            <?= $this->include('admin/categorias/modals/create') ?>
        <?php else: ?>
            <!-- Como precisamos da categoria para o edit, vamos incluí-la via subrequest interno ou buscar via query -->
            <?php 
                $categoriaErro = (new \App\Services\CategoriaService())->getById(old('id')); 
                if ($categoriaErro) {
                    echo $this->include('admin/categorias/modals/edit', ['categoria' => $categoriaErro]);
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