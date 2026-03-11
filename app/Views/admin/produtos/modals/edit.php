<?php 
$isEditingError = !empty(errors()); 
$categoriasList = (new \App\Services\CategoriaService())->getAll();
?>
<div id="modal-editar-produto" 
     x-data="{ show: false }" 
     x-init="$nextTick(() => show = true)"
     x-show="show" 
     style="display: none;" 
     class="fixed inset-0 z-50 bg-gray-900/50 flex items-center justify-center p-4 backdrop-blur-sm" 
     x-transition.opacity.duration.300ms>
    <div class="bg-white rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden" 
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="opacity-0 translate-y-8" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-200 transform" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-8"
         @click.away="show = false; if (!document.getElementById('modal-container').contains($root)) return; setTimeout(() => document.getElementById('modal-container').innerHTML = '', 400)">

        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">Editar Produto</h3>
            <button type="button" @click="show = false; if (!document.getElementById('modal-container').contains($root)) return; setTimeout(() => document.getElementById('modal-container').innerHTML = '', 400)" class="text-gray-400 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <span class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('error') ?></span>
        <form action="<?= route('admin.produtos.update', ['id' => $produto->id]) ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $produto->id ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto</label>
                    <input type="text" name="nome" placeholder="Ex: Arroz Tipo 1 - 5kg" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="<?= $isEditingError ? old('nome') : e($produto->nome) ?>">
                    <?php if ($isEditingError && errors('nome')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('nome') ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                    <select name="categoria_id" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option value="">Selecione...</option>
                        <?php 
                        $currentCat = $isEditingError ? old('categoria_id') : $produto->categoria_id;
                        foreach($categoriasList as $cat): 
                        ?>
                            <option value="<?= $cat->id ?>" <?= ($currentCat == $cat->id) ? 'selected' : '' ?>><?= e($cat->nome) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($isEditingError && errors('categoria_id')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('categoria_id') ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagem Principal</label>
                    <input type="file" name="imagem_url" accept="image/*" class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <?php if ($isEditingError && errors('imagem_url')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('imagem_url') ?></span>
                    <?php endif; ?>
                    <?php if($produto->imagem_url): ?>
                        <p class="text-xs text-gray-500 mt-1">Já possui imagem. Envie outra para substituir.</p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>
                    <input type="number" step="0.01" name="preco" placeholder="0.00" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="<?= $isEditingError ? old('preco') : $produto->preco ?>">
                    <?php if ($isEditingError && errors('preco')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('preco') ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estoque</label>
                    <input type="number" name="estoque" placeholder="Qtd" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="<?= $isEditingError ? old('estoque') : $produto->estoque ?>">
                    <?php if ($isEditingError && errors('estoque')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('estoque') ?></span>
                    <?php endif; ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descrição Detalhada</label>
                    <textarea name="descricao" rows="2" placeholder="Descreva brevemente..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"><?= $isEditingError ? old('descricao') : e($produto->descricao) ?></textarea>
                    <?php if ($isEditingError && errors('descricao')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('descricao') ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="md:col-span-2 flex items-center mt-2">
                    <?php $isActive = $isEditingError ? old('ativo') : $produto->ativo; ?>
                    <input type="hidden" name="ativo" value="0">
                    <input type="checkbox" name="ativo" id="ativo-edit-<?= $produto->id ?>" value="1" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" <?= $isActive ? 'checked' : '' ?>>
                    <label for="ativo-edit-<?= $produto->id ?>" class="ml-2 block text-sm text-gray-700 cursor-pointer">Produto Ativo (Visível na loja)</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" @click="show = false; if (!document.getElementById('modal-container').contains($root)) return; setTimeout(() => document.getElementById('modal-container').innerHTML = '', 400)" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
