<?php $this->layout('layouts/admin', ['title' => 'Gestão de Promoções - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Promoções O Folheto</h2>
            <p class="text-gray-500 text-sm mt-1">Crie descontos programados que alteram o preço do produto na loja.</p>
        </div>
        <button onclick="document.getElementById('modal-nova-promocao').classList.remove('hidden')" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nova Promocão
        </button>
    </div>

    <!-- Lista de Ofertas -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-6 text-sm">
                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-green-500"></span> Promoção Ativa</span>
                <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gray-400"></span> Agendada / Expirada</span>
            </div>
            <div class="text-sm border border-amber-200 bg-amber-50 text-amber-600 px-3 py-1 rounded-full flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Item Capa Ouro
            </div>
        </div>

        <ul class="divide-y divide-gray-100">
            <!-- Promo Item 1 -->
            <li class="flex flex-col md:flex-row md:items-center justify-between p-6 hover:bg-gray-50 transition-colors relative">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500 rounded-r-md"></div>
                
                <div class="pl-4">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20" title="Destaque Home Page"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <h4 class="text-base font-bold text-gray-900 leading-none">Picanha Maturada 1kg</h4>
                    </div>
                    <div class="text-sm text-gray-500 font-medium">
                        Validade: <span class="text-gray-900 border border-gray-200 px-2 py-0.5 rounded-md bg-white">10/03/26</span> até <span class="text-gray-900 border border-gray-200 px-2 py-0.5 rounded-md bg-white">15/03/26</span>
                    </div>
                </div>

                <div class="flex items-center gap-6 pl-4 md:pl-0 mt-4 md:mt-0">
                    <div class="text-right">
                        <span class="block text-xs font-semibold text-gray-400 line-through mb-0.5">Preço Base: R$ 119,90</span>
                        <span class="block text-xl font-bold text-green-600 leading-none">R$ 89,90</span>
                    </div>
                    <button class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50" title="Excluir Promoção">
                        <svg class="w-5 h-5 bg-transparent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </li>

             <!-- Promo Item Inativa -->
             <li class="flex flex-col md:flex-row md:items-center justify-between p-6 opacity-70 bg-gray-50 relative">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gray-300 rounded-r-md"></div>
                
                <div class="pl-4">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-5"></div>
                        <h4 class="text-base font-medium text-gray-600 leading-none">Leite Integral 1L</h4>
                    </div>
                    <div class="text-sm text-gray-400 font-medium line-through decoration-gray-300 decoration-2">
                        Promoção Encerrada Ocorreu Ontem
                    </div>
                </div>

                <div class="flex items-center gap-6 pl-4 md:pl-0 mt-4 md:mt-0 invisible md:visible opacity-50">
                    <div class="text-right">
                        <span class="block text-xl font-bold text-gray-400 leading-none line-through">R$ 3,99</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Modal Nova Promo -->
    <div id="modal-nova-promocao" class="hidden fixed inset-0 z-50 bg-gray-900/40 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto">
        <div class="bg-white rounded-2xl w-full max-w-4xl shadow-xl overflow-hidden my-auto animate-fade-in-up">
            
            <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <div class="flex items-center gap-3">
                    <div class="bg-orange-100 p-2 rounded-lg"><svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    <h3 class="text-lg font-bold text-gray-900">Configurar Desconto</h3>
                </div>
                <button onclick="document.getElementById('modal-nova-promocao').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 transition">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="" method="POST" class="p-8">
                <div class="space-y-6">
                    
                    <!-- Produto Select -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">1. Selecionar Produto do Catálogo</label>
                        <select name="produto_id" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent cursor-pointer appearance-none shadow-sm" required>
                            <option value="">Clique para buscar e selecionar...</option>
                            <option value="1">Picanha Maturada 1kg (Preço Normal: R$ 119,90)</option>
                            <option value="2">Queijo Prato 500g (Preço Normal: R$ 28,50)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1.5 ml-1">Para proteger a concorrência do DB, apenas produtos que não estão ativados aparecem.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <!-- Datas -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Início da Oferta</label>
                                <input type="datetime-local" name="data_inicio" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Fim da Validade</label>
                                <input type="datetime-local" name="data_fim" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                        </div>

                        <!-- Preco Novo -->
                        <div class="flex flex-col justify-center">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Valor Promocional Final</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">R$</span>
                                <input type="number" step="0.01" name="preco_promocional" placeholder="0.00" class="w-full bg-white border border-gray-300 rounded-lg py-4 pl-12 pr-4 text-2xl font-bold text-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent shadow-inner" required>
                            </div>
                            
                            <!-- Destaque Folheto -->
                            <label class="mt-6 flex items-start gap-4 cursor-pointer group bg-white p-4 rounded-xl border border-amber-200 shadow-sm hover:bg-amber-50/50 transition-colors">
                                <input type="checkbox" name="destaque_folheto" value="1" class="w-5 h-5 text-amber-500 border-gray-300 rounded focus:ring-amber-500 mt-0.5 cursor-pointer">
                                <div>
                                    <span class="block text-sm font-bold text-amber-800">Capa do Folheto Destaque</span>
                                    <span class="block text-xs text-amber-700/80 mt-1">Este produto será exibido grande no banner principal da Página Inicial durante o período desta oferta.</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <button type="button" onclick="document.getElementById('modal-nova-promocao').classList.add('hidden')" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                        Cancelar Operação
                    </button>
                    <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors focus:ring-4 focus:ring-blue-100 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Efetivar Desconto
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
