<?php
$isCreatingError = !empty(errors());
$produtosList = $produtosList ?? (new \App\Services\ProdutoService())->getAtivos();
?>
<div id="modal-nova-promocao" 
     x-data="{ show: <?= $isCreatingError ? 'true' : 'false' ?> }" 
     x-show="show" 
     @open-modal-promocao.window="show = true" 
     style="display: none;"
     class="fixed inset-0 z-[60] bg-gray-900/50 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto" 
     x-transition.opacity.duration.300ms>
     
    <div class="bg-white rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden my-auto" 
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="opacity-0 translate-y-8" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-200 transform" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-8"
         @click.away="show = false">
        
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">Nova Promoção</h3>
            <button @click="show = false" type="button" class="text-gray-400 hover:text-gray-700 transition">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="<?= route('admin.promocoes.store') ?>" method="POST" class="p-6">
            <?= csrf_field() ?>
            <?php if (errors('error')): ?>
                <div class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg border border-red-100">
                    <?= errors('error') ?>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                
                <!-- Produto Selecionado -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selecione o Produto</label>
                    <select name="produto_id" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">Selecione um produto...</option>
                        <?php foreach ($produtosList as $produto): ?>
                            <option value="<?= $produto->id ?>" <?= (old('produto_id') == $produto->id) ? 'selected' : '' ?>>
                                <?= e($produto->nome) ?> (Custo: R$ <?= number_format($produto->preco, 2, ',', '.') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (errors('produto_id')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('produto_id') ?></span>
                    <?php endif; ?>
                </div>

                <!-- Data de Início -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Data/Hora Início</label>
                    <input type="datetime-local" name="data_inicio" value="<?= old('data_inicio') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <?php if (errors('data_inicio')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('data_inicio') ?></span>
                    <?php endif; ?>
                </div>

                <!-- Data de Fim -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Data/Hora Fim</label>
                    <input type="datetime-local" name="data_fim" value="<?= old('data_fim') ?>" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <?php if (errors('data_fim')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('data_fim') ?></span>
                    <?php endif; ?>
                </div>

                <!-- Preço Promocional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preço Promocional (R$)</label>
                    <input type="number" step="0.01" name="preco_promocional" value="<?= old('preco_promocional') ?>" placeholder="0.00" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <?php if (errors('preco_promocional')): ?>
                        <span class="text-red-500 text-xs mt-1 block"><?= errors('preco_promocional') ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- Destaque -->
                <div class="flex items-center mt-6">
                    <label class="relative flex items-center cursor-pointer">
                        <input type="hidden" name="destaque_folheto" value="0">
                        <input type="checkbox" name="destaque_folheto" value="1" <?= old('destaque_folheto') ? 'checked' : '' ?> class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Destacar na Capa do Site</span>
                    </label>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <button type="button" @click="show = false" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                    Salvar Promoção
                </button>
            </div>
        </form>
    </div>
</div>
