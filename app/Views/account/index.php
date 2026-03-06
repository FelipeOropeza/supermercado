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

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <nav class="space-y-1 bg-white p-3 rounded-2xl shadow-sm border border-gray-100">
                <a href="/minha-conta" class="bg-green-50 text-green-700 font-semibold flex items-center px-4 py-3 rounded-xl transition">
                    <svg class="mr-3 h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Meus Endereços
                </a>
                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium flex items-center px-4 py-3 rounded-xl transition">
                    <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Meus Pedidos
                </a>
            </nav>
        </div>

        <!-- Área de Conteúdo Principal (Endereços) -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
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
                                        <?php if (!empty($endereco->complemento)): ?>
                                            <p class="text-xs mt-1 text-gray-500 bg-gray-100 rounded px-2 py-1 inline-block">Ref: <?= htmlspecialchars($endereco->complemento) ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-4 flex gap-4 text-sm">
                                        <a href="<?= route('enderecos.edit', ['id' => $endereco->id]) ?>" class="text-green-600 font-bold hover:text-green-800 flex items-center gap-1 transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </a>

                                        <form action="<?= route('enderecos.delete', ['id' => $endereco->id]) ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="text-red-500 font-bold hover:text-red-700 flex items-center gap-1 transition">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $this->endSection(); ?>