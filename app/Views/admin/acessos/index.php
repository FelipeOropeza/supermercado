<?php $this->layout('layouts/admin', ['title' => 'Gestão de Acessos - Admin']); ?>

<div class="max-w-7xl mx-auto w-full">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Controle de Acessos</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie as permissões de acesso ao painel administrativo.</p>
        </div>
        <button hx-get="<?= route('admin.acessos.create') ?>" hx-target="#modal-container" hx-swap="innerHTML" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition-all flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Novo Membro
        </button>
    </div>

    <!-- Quick Stats Bars -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <?php
        $counts = ['admin' => 0, 'gerente' => 0, 'funcionario' => 0];
        foreach ($acessos as $a) {
            $counts[$a->role] = ($counts[$a->role] ?? 0) + 1;
        }
        ?>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-lg"><?= $counts['admin'] ?></div>
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Administrador</p>
                <p class="text-sm font-semibold text-gray-700">Responsáveis</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold text-lg"><?= $counts['gerente'] ?></div>
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Gerentes</p>
                <p class="text-sm font-semibold text-gray-700">Membros Staff</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center font-bold text-lg"><?= $counts['funcionario'] ?></div>
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Funcionários</p>
                <p class="text-sm font-semibold text-gray-700">Operadores</p>
            </div>
        </div>
    </div>

    <!-- Main List: Responsive Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap hidden md:table">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Identificação & Role</th>
                        <th class="py-4 px-6">Contato</th>
                        <th class="py-4 px-6">Documento (CPF)</th>
                        <th class="py-4 px-6 w-32 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <?php
                    $roleColors = [
                        'admin' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                        'gerente' => 'bg-blue-50 text-blue-700 border-blue-100',
                        'funcionario' => 'bg-emerald-50 text-emerald-700 border-emerald-100'
                    ];
                    $roleBadges = [
                        'admin' => 'Admin Root',
                        'gerente' => 'Gerente',
                        'funcionario' => 'Funcionário'
                    ];
                    ?>
                    <?php foreach ($acessos as $acesso):
                        $colorClass = $roleColors[$acesso->role] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                        $avatarColor = strpos($colorClass, 'indigo') !== false ? 'bg-indigo-600' : (strpos($colorClass, 'blue') !== false ? 'bg-blue-600' : 'bg-emerald-600');
                    ?>
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 <?= $avatarColor ?> text-white rounded-lg flex items-center justify-center font-bold shadow-sm shrink-0">
                                        <?= strtoupper($acesso->nome[0]) ?>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 leading-tight"><?= $acesso->nome ?></div>
                                        <div class="mt-1">
                                            <span class="<?= $colorClass ?> text-[10px] font-bold px-2 py-0.5 rounded border uppercase tracking-wider">
                                                <?= $roleBadges[$acesso->role] ?? $acesso->role ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-900"><?= $acesso->email ?></span>
                                    <span class="text-xs text-gray-500"><?= $acesso->telefone ?? 'Não informado' ?></span>
                                </div>
                            </td>
                            <td class="py-5 px-6 font-mono text-xs text-gray-500">
                                <?= $acesso->cpf ?? '---' ?>
                            </td>
                            <td class="py-5 px-6 text-right">
                                <?php if ($acesso->role === 'admin' && $acesso->id == 1): ?>
                                    <span class="text-xs font-semibold text-gray-300 italic">Sistema</span>
                                <?php else: ?>
                                    <div class="flex justify-end gap-2">
                                        <button hx-get="<?= route('admin.acessos.edit', ['id' => $acesso->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all" title="Editar Acesso">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>
                                        <form action="<?= route('admin.acessos.destroy', ['id' => $acesso->id]) ?>" method="POST" onsubmit="return confirm('Deseja realmente remover este acesso?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-all" title="Excluir Acesso">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($acessos)): ?>
                        <tr class="text-gray-400">
                            <td colspan="4" class="py-8 px-6 text-center italic">
                                Nenhum membro da equipe encontrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Mobile View: Cards -->
            <div class="md:hidden divide-y divide-gray-100">
                <?php foreach ($acessos as $acesso):
                    $colorClass = $roleColors[$acesso->role] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                    $avatarColor = strpos($colorClass, 'indigo') !== false ? 'bg-indigo-600' : (strpos($colorClass, 'blue') !== false ? 'bg-blue-600' : 'bg-emerald-600');
                ?>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 <?= $avatarColor ?> text-white rounded-lg flex items-center justify-center font-bold">
                                    <?= strtoupper($acesso->nome[0]) ?>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900"><?= $acesso->nome ?></h4>
                                    <span class="<?= $colorClass ?> text-[10px] font-bold px-1.5 py-0.5 rounded border uppercase tracking-wider">
                                        <?= $roleBadges[$acesso->role] ?? $acesso->role ?>
                                    </span>
                                </div>
                            </div>
                            <?php if (!($acesso->role === 'admin' && $acesso->id == 1)): ?>
                                <div class="flex gap-2">
                                    <button hx-get="<?= route('admin.acessos.edit', ['id' => $acesso->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <form action="<?= route('admin.acessos.destroy', ['id' => $acesso->id]) ?>" method="POST" onsubmit="return confirm('Deseja realmente remover este acesso?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="grid grid-cols-1 gap-2 text-xs">
                            <div class="text-gray-400 flex justify-between italic">
                                <span>E-mail:</span>
                                <span class="text-gray-600 font-medium"><?= $acesso->email ?></span>
                            </div>
                            <div class="text-gray-400 flex justify-between italic">
                                <span>Documento:</span>
                                <span class="text-gray-600 font-medium"><?= $acesso->cpf ?? '---' ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($acessos)): ?>
                    <p class="p-10 text-center text-gray-400 italic">Nenhum membro da equipe encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Container HTMX -->
    <div id="modal-container"></div>

    <?php if (!empty(errors())): ?>
        <?php if (empty(old('id'))): ?>
            <?= $this->include('admin/acessos/modals/create') ?>
        <?php else: ?>
            <?php
            $acessoErro = (new \App\Services\AcessoService())->getById(old('id'));
            if ($acessoErro) {
                echo $this->include('admin/acessos/modals/edit', ['acesso' => $acessoErro]);
            }
            ?>
        <?php endif; ?>
    <?php endif; ?>

</div>