<?php $this->layout('layouts/admin', ['title' => 'Gestão de Acessos - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Acessos da Plataforma</h2>
            <p class="text-gray-500 text-sm mt-1">Controle quem pode administrar as tabelas do supermercado.</p>
        </div>
        <button onclick="document.getElementById('modal-novo-acesso').classList.remove('hidden')" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Adicionar Funcionario
        </button>
    </div>

    <!-- Data Table: Acessos -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600">
                    <tr>
                        <th class="py-4 px-6 font-semibold w-24">ID</th>
                        <th class="py-4 px-6 font-semibold">Credenciais</th>
                        <th class="py-4 px-6 font-semibold w-40 text-center">Nível (Role)</th>
                        <th class="py-4 px-6 font-semibold w-32 text-center">Status</th>
                        <th class="py-4 px-6 font-semibold w-40 text-right">Permissões</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    
                    <!-- Admin Master -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-gray-500 font-mono">01</td>
                        <td class="py-4 px-6">
                            <span class="block text-base font-semibold text-gray-900">Felipe Oropeza</span>
                            <span class="block text-xs text-gray-500 mt-0.5">master@admin.com</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold border border-purple-200 shadow-sm">ADMIN ROOT</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-md text-xs font-semibold">Liberado</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="text-gray-400 cursor-not-allowed font-medium p-1 bg-gray-50 border border-gray-200 rounded px-3" disabled>Sem Edição (Root)</button>
                        </td>
                    </tr>

                    <!-- Gerente Comum -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-gray-500 font-mono">24</td>
                        <td class="py-4 px-6">
                            <span class="block text-base font-medium text-gray-900">Carlos Silva</span>
                            <span class="block text-xs text-gray-500 mt-0.5">carlos.repo@email.com</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Gerente (Staff)</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-md text-xs font-semibold">Liberado</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button class="text-blue-600 hover:text-blue-800 font-medium p-1">Editar</button>
                                <button class="text-red-500 hover:text-red-700 font-medium p-1">Bloquear</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Gerente Bloqueado -->
                    <tr class="bg-gray-50/50 hover:bg-gray-50 transition-colors opacity-75">
                        <td class="py-4 px-6 text-gray-400 font-mono">59</td>
                        <td class="py-4 px-6">
                            <span class="block text-base font-medium text-gray-400 line-through decoration-gray-300">Ana Clara</span>
                            <span class="block text-xs text-gray-400 mt-0.5">ana.clara@email.com</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-gray-200 text-gray-500 px-3 py-1 rounded-full text-xs font-bold">Gerente (Staff)</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-md text-xs font-semibold">Revogado</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="text-green-600 hover:text-green-800 font-medium px-3 py-1 border border-green-200 rounded hover:bg-green-50 transition-colors w-full text-center">Re-liberar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Adicionar Staff -->
    <div id="modal-novo-acesso" class="hidden fixed inset-0 z-50 bg-gray-900/40 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto">
        <div class="bg-white rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden my-auto animate-fade-in-up">
            
            <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Novo Acesso do Staff</h3>
                <button onclick="document.getElementById('modal-novo-acesso').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 transition">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="" method="POST" class="p-8">
                <div class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo</label>
                            <input type="text" name="nome" placeholder="John Silva" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail Comercial</label>
                            <input type="email" name="email" placeholder="nome@supermercado.com" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Senha Provisória</label>
                            <input type="text" name="senha" value="mudar123" class="w-full bg-gray-50 text-gray-600 border border-gray-300 rounded-lg px-4 py-2.5 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                            <p class="text-xs text-gray-500 mt-1">Aconselhe a troca pós login.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nível de Permissão</label>
                            <select name="role" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer shadow-sm appearance-none" required>
                                <option value="funcionario">Gerente (Staff)</option>
                                <option value="admin">Administrador Root (Perigoso)</option>
                            </select>
                        </div>
                    </div>
                    
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-novo-acesso').classList.add('hidden')" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition-colors focus:ring-4 focus:ring-blue-100">
                        Liberar Acesso
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
