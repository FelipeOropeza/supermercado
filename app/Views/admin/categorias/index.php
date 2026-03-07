<?php $this->layout('layouts/admin', ['title' => 'Gestão de Categorias - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Categorias</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie os corredores do seu supermercado online.</p>
        </div>
        <button onclick="document.getElementById('modal-nova-categoria').classList.remove('hidden')" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
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
                        <th class="py-4 px-6 font-semibold w-32">Status</th>
                        <th class="py-4 px-6 font-semibold w-32 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <!-- Item Ativo -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-gray-500 font-medium">#001</td>
                        <td class="py-4 px-6 text-base font-medium">Açougue</td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Ativo</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="text-blue-600 hover:text-blue-800 font-medium p-1">Editar</button>
                                <button class="text-red-500 hover:text-red-700 font-medium p-1">Remover</button>
                            </div>
                        </td>
                    </tr>
                    <!-- Item Deletado -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-gray-400 font-medium">#002</td>
                        <td class="py-4 px-6 text-base text-gray-400">Frios (Inativo)</td>
                        <td class="py-4 px-6">
                            <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-medium">Arquivado</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="text-gray-500 hover:text-gray-700 font-medium p-1">Restaurar</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Nova Categoria -->
    <div id="modal-nova-categoria" class="hidden fixed inset-0 z-50 bg-gray-900/50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl overflow-hidden animate-fade-in-up">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Nova Categoria</h3>
                <button onclick="document.getElementById('modal-nova-categoria').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="" method="POST" class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome Oficial</label>
                    <input type="text" name="nome" placeholder="Ex: Mercearia, Padaria..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                    <p class="text-xs text-gray-500 mt-2">Nome visível para os clientes do seu supermercado.</p>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descrição (Opcional)</label>
                    <textarea name="descricao" rows="2" placeholder="Descreva brevemente esta categoria..." class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="document.getElementById('modal-nova-categoria').classList.add('hidden')" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.3s ease-out forwards; }
</style>
