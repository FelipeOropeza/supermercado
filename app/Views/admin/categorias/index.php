<?php $this->layout('layouts/admin', ['title' => 'Gestão de Categorias - Admin']); ?>
<?php $role = session('user')['role'] ?? 'cliente'; ?>

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
                        <?php if ($role !== 'funcionario'): ?>
                            <th class="py-4 px-6 font-semibold w-32 text-right">Ação</th>
                        <?php endif; ?>
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
                                <?php if ($role !== 'funcionario'): ?>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <?php if (in_array($role, ['admin', 'gerente'])): ?>
                                                <button hx-get="<?= route('admin.categorias.edit', ['id' => $categoria->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all" title="Editar Categoria">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($role === 'admin'): ?>
                                                <form action="<?= route('admin.categorias.destroy', ['id' => $categoria->id]) ?>" method="POST" onsubmit="return confirm('Deseja realmente remover esta categoria?')">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-all" title="Excluir Categoria">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
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