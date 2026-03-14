<?php $this->layout('layouts/admin', ['title' => 'Gestão de Categorias - Admin']); ?>
<?php $role = session('user')['role'] ?? 'cliente'; ?>

<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8" x-data="{ }">

    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Categorias</h1>
            <p class="text-gray-500 font-medium mt-2">Gerencie os corredores do seu supermercado inteligente.</p>
        </div>
        
        <?php if (in_array($role, ['admin', 'gerente'])): ?>
            <button hx-get="<?= route('admin.categorias.create') ?>" 
                    hx-target="#modal-container"
                    class="group relative bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-0.5 active:translate-y-0 active:shadow-md flex items-center gap-3 overflow-hidden">
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out"></div>
                <div class="relative flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    <span>Nova Categoria</span>
                </div>
            </button>
        <?php endif; ?>
    </div>

    <!-- Container da Tabela e Cards com Efeito Glass -->
    <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] shadow-xl border border-gray-100/50 overflow-hidden relative">
        
        <!-- Desktop Table View -->
        <div class="overflow-x-auto p-4 hidden md:block">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-gray-400 font-bold text-[10px] uppercase tracking-widest pl-4">
                        <th class="px-6 py-4 rounded-l-2xl">ID</th>
                        <th class="px-6 py-4">Nome da Categoria</th>
                        <th class="px-6 py-4">Descrição</th>
                        <?php if ($role !== 'funcionario'): ?>
                            <th class="px-6 py-4 text-center rounded-r-2xl">Ação</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-medium">
                    <?php if (empty($categorias)): ?>
                        <tr>
                            <td colspan="4">
                                <div class="flex flex-col items-center justify-center p-16 text-center bg-gray-50/50 rounded-3xl border-2 border-dashed border-gray-100">
                                    <div class="w-24 h-24 mb-6 text-gray-200">
                                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM5 19V5h14l.002 14H5z"></path><path d="M7 7h10v2H7zm0 4h10v2H7zm0 4h7v2H7z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhuma categoria encontrada</h3>
                                    <p class="text-gray-400 max-w-sm">Comece criando os corredores para organizar seus produtos na loja.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <tbody class="text-gray-700 text-sm font-medium" x-data="{ expanded: false }">
                                <tr class="group bg-white hover:bg-blue-50/30 transition-colors duration-200 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] border border-gray-100 rounded-2xl cursor-pointer" @click="expanded = !expanded">
                                    <td class="px-6 py-5 rounded-l-2xl border-y border-l border-gray-100/50 group-hover:border-blue-100/50 transition-colors">
                                        <span class="text-xs font-black text-gray-400 group-hover:text-blue-400 transition-colors">#<?= str_pad((string)$categoria->id, 4, '0', STR_PAD_LEFT) ?></span>
                                    </td>
                                    
                                    <td class="px-6 py-5 border-y border-gray-100/50 group-hover:border-blue-100/50 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="h-12 w-12 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 text-gray-400 shadow-sm transition-all duration-300 group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-500" :class="expanded ? 'bg-blue-50 border-blue-100 text-blue-500' : ''">
                                                <svg class="w-6 h-6 transition-transform duration-300" :class="expanded ? 'rotate-12 scale-110' : 'group-hover:scale-105'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                            </div>
                                            <div>
                                                <span class="block text-base font-black text-gray-900 group-hover:text-blue-700 transition-colors"><?= e($categoria->nome) ?></span>
                                                <?php if ($categoria->deleted_at): ?>
                                                    <span class="inline-flex items-center gap-1 text-[9px] font-black text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full border border-orange-100 uppercase tracking-widest mt-1">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> Suspensas
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 border-y border-gray-100/50 group-hover:border-blue-100/50 transition-colors w-full">
                                        <p class="text-gray-500 font-medium text-sm line-clamp-2 max-w-md">
                                            <?= e($categoria->descricao ?: 'Sem descrição informada.') ?>
                                        </p>
                                        <div class="text-[10px] font-bold text-gray-400 mt-2 flex items-center gap-1 group-hover:text-blue-500 transition-colors">
                                            <span x-text="expanded ? 'Ocultar produtos' : 'Ver produtos'"></span>
                                            <svg class="w-3 h-3 transition-transform duration-300" :class="expanded ? 'rotate-180 text-blue-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>

                                    <?php if ($role !== 'funcionario'): ?>
                                        <td class="px-6 py-5 rounded-r-2xl border-y border-r border-gray-100/50 group-hover:border-transparent" @click.stop>
                                            <div class="flex justify-center items-center gap-3">
                                                <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100 shadow-sm">
                                                    <button hx-get="<?= route('admin.categorias.edit', ['id' => $categoria->id]) ?>" 
                                                            hx-target="#modal-container" hx-swap="innerHTML" 
                                                            class="p-2.5 text-gray-400 hover:text-blue-600 hover:bg-white rounded-lg transition-all hover:shadow" 
                                                            title="Editar">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    </button>

                                                    <?php if ($role === 'admin'): ?>
                                                        <div class="w-px bg-gray-200 mx-1"></div>
                                                        <?php if ($categoria->deleted_at): ?>
                                                            <form action="<?= route('admin.categorias.restore', ['id' => $categoria->id]) ?>" method="POST">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" 
                                                                        class="p-2.5 text-orange-500 hover:text-orange-600 hover:bg-white rounded-lg transition-all hover:shadow" 
                                                                        title="Restaurar Categoria e Produtos">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                                </button>
                                                            </form>
                                                        <?php else: ?>
                                                            <form action="<?= route('admin.categorias.destroy', ['id' => $categoria->id]) ?>" method="POST" x-data @submit.prevent="if(confirm('Tem certeza que deseja apagar a categoria <?= e($categoria->nome) ?>? Todos os produtos vinculados a ela também serão removidos da loja.')) $el.submit()">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" 
                                                                        class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-white rounded-lg transition-all hover:shadow" 
                                                                        title="Excluir">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                
                                <!-- Expansão: Produtos vinculados -->
                                <tr x-show="expanded" x-collapse style="display: none;">
                                    <td colspan="<?= $role !== 'funcionario' ? '4' : '3' ?>" class="p-0">
                                        <div class="mx-2 mb-4 mt-0 p-6 bg-gray-50/80 rounded-2xl border border-gray-200/60 shadow-inner">
                                            <div class="flex items-center gap-3 mb-4">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                <h4 class="text-[11px] font-black text-gray-500 uppercase tracking-widest">Produtos neste corredor</h4>
                                            </div>
                                            
                                            <?php $produtos = $categoria->produtos; ?>
                                            
                                            <?php if (empty($produtos)): ?>
                                                <div class="text-center py-6 bg-white rounded-xl border border-gray-100 border-dashed">
                                                    <span class="text-gray-400 font-medium text-sm">Nenhum produto cadastrado nesta categoria.</span>
                                                </div>
                                            <?php else: ?>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
                                                    <?php foreach ($produtos as $prod): ?>
                                                        <div class="bg-white border border-gray-100 p-3 rounded-xl flex items-center gap-4 hover:border-blue-200 transition-colors shadow-sm cursor-default" @click.stop>
                                                            <div class="w-12 h-12 rounded-lg bg-gray-50 flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-100/50">
                                                                <?php if ($prod->imagem_url): ?>
                                                                    <img src="<?= storage_url($prod->imagem_url) ?>" class="w-full h-full object-cover">
                                                                <?php else: ?>
                                                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-bold text-gray-900 truncate" title="<?= e($prod->nome) ?>"><?= e($prod->nome) ?></p>
                                                                <div class="flex items-center justify-between mt-1">
                                                                    <span class="text-xs font-black text-green-600">R$ <?= number_format($prod->preco, 2, ',', '.') ?></span>
                                                                    <?php if ($prod->ativo): ?>
                                                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-blue-50 text-blue-600 uppercase tracking-widest border border-blue-100">Ativo</span>
                                                                    <?php else: ?>
                                                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-red-50 text-red-600 uppercase tracking-widest border border-red-100">Oculto</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-100">
            <?php if (empty($categorias)): ?>
                <div class="p-10 text-center text-gray-500 font-medium">Nenhuma categoria encontrada.</div>
            <?php else: ?>
                <?php foreach ($categorias as $categoria): ?>
                    <div class="p-5 flex flex-col gap-4" x-data="{ expanded: false }">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-4 flex-1 min-w-0" @click="expanded = !expanded">
                                <div class="h-12 w-12 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 text-gray-400 shrink-0" :class="expanded ? 'bg-blue-50 border-blue-100 text-blue-500' : ''">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                </div>
                                <div class="truncate">
                                    <h4 class="font-black text-gray-900 truncate"><?= e($categoria->nome) ?></h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">#<?= str_pad((string)$categoria->id, 4, '0', STR_PAD_LEFT) ?></span>
                                        <?php if ($categoria->deleted_at): ?>
                                            <span class="text-[8px] font-black text-orange-600 bg-orange-50 px-1.5 py-0.5 rounded-full border border-orange-100 uppercase tracking-widest">Suspenso</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if ($role !== 'funcionario'): ?>
                                <div class="flex gap-1">
                                    <button hx-get="<?= route('admin.categorias.edit', ['id' => $categoria->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-2.5 text-blue-600 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <?php if ($role === 'admin'): ?>
                                        <?php if ($categoria->deleted_at): ?>
                                            <form action="<?= route('admin.categorias.restore', ['id' => $categoria->id]) ?>" method="POST">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="p-2.5 text-orange-600 bg-orange-50 border border-orange-100 rounded-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?= route('admin.categorias.destroy', ['id' => $categoria->id]) ?>" method="POST" onsubmit="return confirm('Excluir categoria?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="p-2.5 text-red-600 bg-red-50 border border-red-100 rounded-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div @click="expanded = !expanded" class="flex items-center justify-between bg-gray-50/50 p-2 rounded-lg border border-gray-100 cursor-pointer">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest" x-text="expanded ? 'Ocultar Detalhes' : 'Ver Detalhes & Produtos'"></span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>

                        <div x-show="expanded" x-collapse style="display: none;">
                            <div class="flex flex-col gap-4">
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Descrição</span>
                                    <p class="text-xs text-gray-600 font-medium"><?= e($categoria->descricao ?: 'Sem descrição.') ?></p>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Produtos (<?= count($categoria->produtos) ?>)</span>
                                    <div class="grid grid-cols-1 gap-2">
                                        <?php foreach ($categoria->produtos as $prod): ?>
                                            <div class="flex items-center gap-3 bg-white p-2 rounded-lg border border-gray-100 shadow-sm">
                                                <div class="h-8 w-8 rounded-md overflow-hidden bg-gray-50 flex-shrink-0">
                                                    <?php if ($prod->imagem_url): ?>
                                                        <img src="<?= storage_url($prod->imagem_url) ?>" class="w-full h-full object-cover">
                                                    <?php else: ?>
                                                        <div class="flex items-center justify-center h-full text-gray-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-[11px] font-bold text-gray-900 truncate"><?= e($prod->nome) ?></p>
                                                    <span class="text-[10px] font-black text-green-600">R$ <?= number_format($prod->preco, 2, ',', '.') ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php if (empty($categoria->produtos)): ?>
                                            <p class="text-[10px] text-gray-400 italic text-center py-2">Nenhum produto vinculado.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Container HTMX -->
    <div id="modal-container"></div>
    
    <!-- Modais de Erro Direto na Página -->
    <?php if (!empty(errors())): ?>
        <?php if (empty(old('id'))): ?>
            <?= $this->include('admin/categorias/modals/create') ?>
        <?php else: ?>
            <?php 
                $categoriaErro = (new \App\Services\CategoriaService())->getById(old('id')); 
                if ($categoriaErro) {
                    echo $this->include('admin/categorias/modals/edit', ['categoria' => $categoriaErro]);
                }
            ?>
        <?php endif; ?>
    <?php endif; ?>
</div>