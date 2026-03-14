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

    <!-- Main List: Responsive Table & Premium Cards -->
    <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] shadow-xl border border-gray-100/50 overflow-hidden relative">
        <div class="overflow-x-auto">
            <!-- Desktop View -->
            <table class="w-full text-left text-sm whitespace-nowrap hidden md:table border-separate border-spacing-y-2 px-4">
                <thead>
                    <tr class="text-gray-400 font-bold text-[10px] uppercase tracking-widest pl-4">
                        <th class="py-4 px-6 rounded-l-2xl">Identificação & Cargo</th>
                        <th class="py-4 px-6">Contato</th>
                        <th class="py-4 px-6">Documento (CPF)</th>
                        <th class="py-4 px-6 w-32 text-center rounded-r-2xl">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 font-medium">
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
                        <tr class="hover:bg-blue-50/20 transition-all group bg-white border border-gray-100/50 rounded-2xl shadow-sm">
                            <td class="py-5 px-6 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 <?= $avatarColor ?> text-white rounded-xl flex items-center justify-center font-black shadow-lg shadow-<?= explode('-', str_replace('bg-', '', $avatarColor))[0] ?>-200/50 shrink-0 transform group-hover:scale-110 transition-transform">
                                        <?= strtoupper($acesso->nome[0]) ?>
                                    </div>
                                    <div>
                                        <div class="text-base font-black text-gray-900 leading-tight group-hover:text-blue-700 transition-colors"><?= $acesso->nome ?></div>
                                        <div class="mt-1">
                                            <span class="<?= $colorClass ?> text-[9px] font-black px-2.5 py-0.5 rounded-full border uppercase tracking-widest">
                                                <?= $roleBadges[$acesso->role] ?? $acesso->role ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="flex flex-col gap-1">
                                    <span class="font-bold text-gray-900"><?= $acesso->email ?></span>
                                    <span class="text-[11px] text-gray-400 font-black uppercase tracking-widest flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <?= $acesso->telefone ?? 'Não informado' ?>
                                    </span>
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="bg-gray-50 px-3 py-1 rounded-lg border border-gray-100 font-mono text-xs text-gray-500">
                                    <?= $acesso->cpf ?? '---' ?>
                                </span>
                            </td>
                            <td class="py-5 px-6 rounded-r-2xl">
                                <?php if ($acesso->role === 'admin' && $acesso->id == 1): ?>
                                    <div class="flex justify-center text-center">
                                        <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-full border border-gray-100">Sistema</span>
                                    </div>
                                <?php else: ?>
                                    <div class="flex justify-center items-center gap-3">
                                        <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100 shadow-inner">
                                            <button hx-get="<?= route('admin.acessos.edit', ['id' => $acesso->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-2.5 text-gray-400 hover:text-blue-600 hover:bg-white rounded-lg transition-all hover:shadow-sm" title="Editar Acesso">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </button>
                                            <div class="w-px bg-gray-200 mx-1"></div>
                                            <form action="<?= route('admin.acessos.destroy', ['id' => $acesso->id]) ?>" method="POST" onsubmit="return confirm('Deseja realmente remover este acesso?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-white rounded-lg transition-all hover:shadow-sm" title="Excluir Acesso">
                                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($acessos)): ?>
                        <tr>
                            <td colspan="4" class="py-20 text-center">
                                <p class="text-gray-400 font-medium italic">Nenhum membro da equipe encontrado.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Mobile View: Premium Cards -->
            <div class="md:hidden divide-y divide-gray-100">
                <?php foreach ($acessos as $acesso):
                    $colorClass = $roleColors[$acesso->role] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                    $avatarColor = strpos($colorClass, 'indigo') !== false ? 'bg-indigo-600' : (strpos($colorClass, 'blue') !== false ? 'bg-blue-600' : 'bg-emerald-600');
                ?>
                    <div class="p-5 flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 <?= $avatarColor ?> text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-gray-200 text-xl shrink-0">
                                    <?= strtoupper($acesso->nome[0]) ?>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-black text-gray-900 truncate leading-none mb-2"><?= $acesso->nome ?></h4>
                                    <span class="<?= $colorClass ?> text-[9px] font-black px-2 py-0.5 rounded-full border border-opacity-50 uppercase tracking-widest whitespace-nowrap">
                                        <?= $roleBadges[$acesso->role] ?? $acesso->role ?>
                                    </span>
                                </div>
                            </div>
                            
                            <?php if (!($acesso->role === 'admin' && $acesso->id == 1)): ?>
                                <div class="flex gap-2 bg-gray-50 p-1 rounded-xl border border-gray-100 shadow-sm">
                                    <button hx-get="<?= route('admin.acessos.edit', ['id' => $acesso->id]) ?>" hx-target="#modal-container" hx-swap="innerHTML" class="p-2 text-blue-600 bg-white border border-gray-100 rounded-lg shadow-sm active:scale-95 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <form action="<?= route('admin.acessos.destroy', ['id' => $acesso->id]) ?>" method="POST" onsubmit="return confirm('Excluir acesso?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-2 text-red-600 bg-white border border-gray-100 rounded-lg shadow-sm active:scale-95 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <span class="text-[9px] font-black text-gray-300 uppercase bg-gray-50 px-2 py-1 rounded border border-gray-100">Root</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100/50 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center border border-gray-200 shadow-sm text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-700 truncate"><?= $acesso->email ?></span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center border border-gray-200 shadow-sm text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="text-xs font-mono text-gray-600"><?= $acesso->cpf ?? 'Não informado' ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($acessos)): ?>
                    <div class="p-10 text-center text-gray-400 italic">Nenhum membro da equipe.</div>
                <?php endif; ?>
            </div>
        </div>
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