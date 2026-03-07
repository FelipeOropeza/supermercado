<?php $this->layout('layouts/admin', ['title' => 'Gestão de Produtos - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Produtos</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie os itens, imagens e preços do catálogo.</p>
        </div>
        <button onclick="document.getElementById('modal-novo-produto').classList.remove('hidden')" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Novo Produto
        </button>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        <!-- Product Card 1 -->
        <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col">
            <div class="relative h-48 bg-gray-50 flex items-center justify-center border-b border-gray-100 overflow-hidden">
                <span class="absolute top-3 left-3 bg-gray-900 text-white px-2 py-0.5 rounded text-xs font-semibold tracking-wide">AÇOUGUE</span>
                <span class="absolute top-3 right-3 bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-semibold">45 UN</span>
                
                <div class="w-20 h-20 bg-white shadow-sm rounded-2xl flex items-center justify-center text-4xl transform group-hover:scale-110 transition-transform duration-300">🥩</div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">Picanha Maturada 1kg</h3>
                <p class="text-xs text-gray-500 mb-4 line-clamp-2 mt-1">Corte nobre congelado com capa de gordura média.</p>
                
                <div class="mt-auto flex justify-between items-end border-t border-gray-50 pt-4">
                    <div>
                        <span class="text-xs text-gray-400 font-medium block">Preço de Venda</span>
                        <span class="text-xl font-bold text-gray-900">R$ 119,90</span>
                    </div>
                    <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-2 text-gray-500 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                        <button class="p-2 text-gray-400 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                    </div>
                </div>
            </div>
        </article>

        <!-- Product Card 2 (Esgotado) -->
        <article class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col">
            <div class="relative h-48 bg-red-50/50 flex items-center justify-center border-b border-red-50 overflow-hidden">
                <span class="absolute top-3 left-3 bg-gray-900 text-white px-2 py-0.5 rounded text-xs font-semibold tracking-wide">FRIOS</span>
                <span class="absolute top-3 right-3 bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-semibold animate-pulse">ESGOTADO</span>
                
                <div class="w-20 h-20 bg-white shadow-sm rounded-2xl flex items-center justify-center text-4xl grayscale opacity-60">🧀</div>
            </div>
            <div class="p-5 flex flex-col flex-grow opacity-75">
                <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">Queijo Prato 500g</h3>
                <p class="text-xs text-gray-500 mb-4 line-clamp-2 mt-1">Fatiado e sem lactose.</p>
                
                <div class="mt-auto flex justify-between items-end border-t border-gray-50 pt-4">
                    <div>
                        <span class="text-xs text-gray-400 font-medium block">Preço de Venda</span>
                        <span class="text-xl font-bold text-gray-900">R$ 28,50</span>
                    </div>
                    <div class="flex space-x-1">
                        <button class="p-2 text-gray-500 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                    </div>
                </div>
            </div>
        </article>

    </div>

    <!-- Modal Novo Produto -->
    <div id="modal-novo-produto" class="hidden fixed inset-0 z-50 bg-gray-900/50 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto w-full">
        <div class="bg-white rounded-2xl w-full max-w-3xl shadow-2xl overflow-hidden my-auto animate-fade-in-up">
            
            <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-gray-900">Cadastrar Novo Produto</h3>
                <button onclick="document.getElementById('modal-novo-produto').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 transition">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                    
                    <!-- Dados Essenciais -->
                    <div class="md:col-span-3 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nome do Produto</label>
                            <input type="text" name="nome" placeholder="Ex: Arroz Tipo 1 - 5kg" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Categoria</label>
                            <select name="categoria_id" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none cursor-pointer" required>
                                <option value="">Selecione uma categoria...</option>
                                <option value="1">Açougue</option>
                                <option value="2">Frios e Laticínios</option>
                            </select>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Preço Normal (R$)</label>
                                <input type="number" step="0.01" name="preco" placeholder="0.00" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Estoque (Un.)</label>
                                <input type="number" name="estoque" placeholder="Ex: 50" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                            </div>
                        </div>
                    </div>

                    <!-- Mídia e Descrição -->
                    <div class="md:col-span-2 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Imagem Principal</label>
                            <div class="w-full h-32 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center bg-gray-50 flex-col hover:bg-blue-50 hover:border-blue-400 transition-colors cursor-pointer group relative">
                                <input type="file" name="imagem" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500 transition-colors mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium text-gray-500 group-hover:text-blue-600 text-center px-4">Clique para fazer upload</span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Detalhes (Opcional)</label>
                            <textarea name="descricao" rows="2" placeholder="Marca, peso, observações..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-novo-produto').classList.add('hidden')" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors focus:ring-4 focus:ring-blue-100">
                        Salvar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.3s ease-out forwards; }
</style>
