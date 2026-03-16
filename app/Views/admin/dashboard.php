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
                <p class="text-sm font-medium text-gray-500">Categorias</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1"><?= $totalCategorias ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl font-bold">C</div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Produtos</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1"><?= $totalProdutos ?></p>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl font-bold">P</div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-medium text-gray-500">Promoções</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1"><?= $totalPromocoes ?></p>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-xl font-bold">%</div>
        </div>

        <!-- Card 4 -->
        <?php if (session('user')['role'] === 'admin'): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-sm font-medium text-gray-500">Staff Ativo</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-1">4</p>
                </div>
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl font-bold">U</div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Alertas de Estoque Baixo -->
    <?php if (!empty($produtosBaixoEstoque)): ?>
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Alertas de Estoque Baixo</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($produtosBaixoEstoque as $produto): ?>
                    <div class="bg-white border-l-4 border-red-500 rounded-xl shadow-sm p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <?php if ($produto->imagem_url): ?>
                                <img src="<?= storage_url($produto->imagem_url) ?>" class="w-10 h-10 rounded-lg object-cover bg-gray-100">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-500 font-bold text-xs">!</div>
                            <?php endif; ?>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900"><?= htmlspecialchars($produto->nome) ?></h4>
                                <p class="text-[11px] text-gray-500 italic"><?= $produto->categoria->nome ?? 'S/ Categoria' ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-red-600 block leading-none"><?= $produto->estoque ?> un</span>
                            <span class="text-[9px] text-gray-400 uppercase font-black uppercase tracking-tighter">em estoque</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Seção de Bem-Vindo -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Bem-vindo ao Novo Painel Administrativo!</h3>
            <p class="text-gray-600 mb-6">Esta é a sua área de gestão moderna e limpa. Navegue usando o menu lateral para iniciar as configurações de catálogo e usuários do seu supermercado.</p>

            <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-500 text-left font-mono border border-gray-200">
                <p>> Status: Online</p>
                <p>> Ambiente: Administrativo (Seguro)</p>
                <p>> Usuário Autenticado: <?= session('user')['nome'] ?> (<?= session('user')['role'] ?>)</p>
            </div>
        </div>
    </div>

</div>