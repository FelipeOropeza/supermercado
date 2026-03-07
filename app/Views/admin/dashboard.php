<?php $this->layout('layouts/admin', ['title' => 'Dashboard - ManagerPro']); ?>

<div class="max-w-7xl mx-auto w-full">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
        <p class="text-sm text-gray-500 mt-1">Visão geral do sistema e atalhos rápidos.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Categorias Ativas</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">12</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl font-bold">C</div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Produtos</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">145</p>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl font-bold">P</div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Promoções</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">3</p>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-xl font-bold">%</div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Staff Ativo</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">4</p>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl font-bold">U</div>
        </div>
    </div>

    <!-- Seção de Bem-Vindo -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Bem-vindo ao Novo Painel Administrativo!</h3>
            <p class="text-gray-600 mb-6">Esta é a sua área de gestão moderna e limpa. Navegue usando o menu lateral para iniciar as configurações de catálogo e usuários do seu supermercado.</p>
            
            <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-500 text-left font-mono border border-gray-200">
                <p>> Status: Online</p>
                <p>> Ambiente: Administrativo (Seguro)</p>
                <p>> Usuário Autenticado: Admin Root</p>
            </div>
        </div>
    </div>

</div>
