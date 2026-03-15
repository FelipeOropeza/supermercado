<?php $this->layout('layouts/main', ['title' => 'Minha Conta | Supermercado']); ?>

<?php $this->section('content'); ?>
<main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Minha Conta</h1>
        <p class="text-gray-500 mt-2 text-sm">Gerencie seus pedidos, dados pessoais e endereços de entrega.</p>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 text-sm" role="alert">
            <?= htmlspecialchars(session()->get('success')) ?>
        </div>
        <?php session()->remove('success'); ?>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <nav class="space-y-1 bg-white p-3 rounded-2xl shadow-sm border border-gray-100">
                <a href="/minha-conta" class="<?= $tab === 'enderecos' ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' ?> flex items-center px-4 py-3 rounded-xl transition">
                    <svg class="mr-3 h-5 w-5 <?= $tab === 'enderecos' ? 'text-green-500' : 'text-gray-400' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Meus Endereços
                </a>
                <a href="/minha-conta/pedidos" class="<?= $tab === 'pedidos' ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' ?> flex items-center px-4 py-3 rounded-xl transition">
                    <svg class="mr-3 h-5 w-5 <?= $tab === 'pedidos' ? 'text-green-500' : 'text-gray-400' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Meus Pedidos
                </a>
            </nav>
        </div>

        <!-- Área de Conteúdo Principal -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <?php if ($tab === 'enderecos'): ?>
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Endereços de Entrega</h3>
                            <p class="text-xs text-gray-500 mt-1">Gerencie onde você deseja receber as suas compras.</p>
                        </div>
                        <a href="/minha-conta/enderecos/novo" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded-xl shadow-sm transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Adicionar
                        </a>
                    </div>

                    <div class="p-6">
                        <?php if (empty($enderecos)): ?>
                            <div class="text-center py-10 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-bold text-gray-900">Nenhum endereço cadastrado</h3>
                                <p class="mt-1 text-sm text-gray-500">Comece cadastrando um endereço de entrega padrão.</p>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php foreach ($enderecos as $endereco): ?>
                                    <div class="relative border rounded-xl p-5 bg-white hover:border-green-500 transition shadow-sm group">
                                        <div class="absolute top-4 right-4 text-gray-400 group-hover:text-green-500 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-2 truncate"><?= htmlspecialchars($endereco->rua) ?>, <?= htmlspecialchars($endereco->numero) ?></h4>
                                        <div class="text-sm text-gray-600 space-y-1">
                                            <p><?= htmlspecialchars($endereco->bairro) ?></p>
                                            <p><?= htmlspecialchars($endereco->cidade) ?> - <?= htmlspecialchars($endereco->estado) ?></p>
                                            <p class="text-xs text-gray-400 font-mono mt-2">CEP: <?= htmlspecialchars($endereco->cep) ?></p>
                                        </div>
                                        <div class="mt-4 flex gap-4 text-sm">
                                            <a href="<?= route('enderecos.edit', ['id' => $endereco->id]) ?>" class="text-green-600 font-bold hover:text-green-800 flex items-center gap-1 transition">Editar</a>
                                            <form action="<?= route('enderecos.delete', ['id' => $endereco->id]) ?>" method="POST" onsubmit="return confirm('Tem certeza?');" class="inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="text-red-500 font-bold hover:text-red-700">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php elseif ($tab === 'pedidos'): ?>
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Histórico de Pedidos</h3>
                        <p class="text-xs text-gray-500 mt-1">Veja seus pedidos realizados e o status de cada um.</p>
                    </div>

                    <div class="p-6">
                        <?php if (empty($pedidos)): ?>
                            <div class="text-center py-20 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                                    <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Você ainda não fez nenhum pedido</h3>
                                <p class="mt-1 text-sm text-gray-500">Explore nosso catálogo e faça sua primeira compra!</p>
                                <a href="/" class="mt-6 inline-block bg-green-600 text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-green-700 transition">Ver Produtos</a>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($pedidos as $pedido): ?>
                                    <div class="border border-gray-100 rounded-xl p-6 bg-white hover:shadow-md transition duration-300">
                                        <div class="flex flex-wrap items-center justify-between gap-4 mb-4 pb-4 border-b border-gray-50">
                                            <div>
                                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Pedido #<?= str_pad((string)$pedido->id, 6, '0', STR_PAD_LEFT) ?></p>
                                                <p class="text-sm text-gray-900 font-bold"><?= date('d/m/Y \à\s H:i', strtotime($pedido->created_at)) ?></p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total</p>
                                                <p class="text-lg text-emerald-900 font-black">R$ <?= number_format($pedido->valor_total + $pedido->taxa_entrega, 2, ',', '.') ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                                                    <?= htmlspecialchars($pedido->status) ?>
                                                </span>
                                                <p class="text-xs text-gray-500 font-medium">Pagamento: <?= ucfirst($pedido->forma_pagamento_entrega) ?></p>
                                            </div>
                                            <a href="<?= route('minha-conta.pedido.view', ['id' => $pedido->id]) ?>" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition">Ver detalhes</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>
<?php $this->endSection(); ?>