<?php $isCreatingError = empty(old('id')) && !empty(errors()); ?>
<div id="modal-nova-categoria" class="fixed inset-0 z-50 bg-gray-900/50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl overflow-hidden animate-fade-in-up">

        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">Nova Categoria</h3>
            <button onclick="document.getElementById('modal-nova-categoria').remove()" class="text-gray-400 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <span class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('error') ?></span>
        <form action="<?= route('admin.categorias.store') ?>" method="POST" class="p-6">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Oficial</label>
                <input type="text" name="nome" placeholder="Ex: Mercearia, Padaria..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" value="<?= $isCreatingError ? old('nome') : '' ?>">
                <p class="text-xs text-gray-500 mt-2">Nome visível para os clientes do seu supermercado.</p>
                <?php if ($isCreatingError && errors('nome')): ?>
                    <span class="text-red-500 text-sm"><?= errors('nome') ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição (Opcional)</label>
                <textarea name="descricao" rows="2" placeholder="Descreva brevemente esta categoria..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"><?= $isCreatingError ? old('descricao') : '' ?></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="document.getElementById('modal-nova-categoria').remove()" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
