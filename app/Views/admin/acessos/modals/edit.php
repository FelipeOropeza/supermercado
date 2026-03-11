<!-- Modal Editar Acesso (Página Overlay) -->
<div id="modal-editar-acesso" class="fixed inset-0 z-[60] flex justify-end transition-all duration-300">
    <!-- Backdrop -->
    <div id="modal-backdrop" class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity opacity-0 animate-fade-in" onclick="closeSidePage('modal-editar-acesso')"></div>
    
    <!-- Content Card (Página Lateral) -->
    <div id="modal-content" class="relative w-full max-w-2xl bg-white h-screen shadow-2xl overflow-y-auto animate-slide-in-right flex flex-col">
        
        <!-- Modal Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Editar Acesso Staff</h3>
                <p class="text-gray-500 text-sm">Atualizar credenciais e permissões</p>
            </div>
            <button onclick="closeSidePage('modal-editar-acesso')" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="<?= route('admin.acessos.update', ['id' => $acesso->id]) ?>" method="POST" class="p-8 flex-grow flex flex-col">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $acesso->id ?>">
            <div class="space-y-6">

                <!-- Nome Completo -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nome Completo</label>
                    <input type="text" name="nome" value="<?= old('nome', $acesso->nome) ?>" placeholder="John Doe" class="w-full bg-gray-50 border <?= errors('nome') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all placeholder:text-gray-400">
                    <?php if (errors('nome')): ?>
                        <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('nome') ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- E-mail -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">E-mail Comercial</label>
                        <input type="email" name="email" value="<?= old('email', $acesso->email) ?>" placeholder="nome@mercado.com.br" class="w-full bg-gray-50 border <?= errors('email') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('email')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('email') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- CPF -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">CPF</label>
                        <input type="text" name="cpf" value="<?= old('cpf', $acesso->cpf) ?>" placeholder="000.000.000-00" class="w-full bg-gray-50 border <?= errors('cpf') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('cpf')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('cpf') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Telefone</label>
                        <input type="text" name="telefone" value="<?= old('telefone', $acesso->telefone) ?>" placeholder="(00) 00000-0000" class="w-full bg-gray-50 border <?= errors('telefone') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('telefone')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('telefone') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nível de Acesso</label>
                        <div class="relative">
                            <select name="role" class="w-full bg-gray-50 border <?= errors('role') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all cursor-pointer appearance-none">
                                <option value="funcionario" <?= old('role', $acesso->role) === 'funcionario' ? 'selected' : '' ?>>Funcionário</option>
                                <option value="gerente" <?= old('role', $acesso->role) === 'gerente' ? 'selected' : '' ?>>Gerente</option>
                                <option value="admin" <?= old('role', $acesso->role) === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <?php if (errors('role')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('role') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Senha -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nova Senha (opcional)</label>
                        <input type="password" name="senha" placeholder="Deixe em branco para manter" class="w-full bg-gray-50 border <?= errors('senha') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('senha')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('senha') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="mt-auto pt-8 border-t border-gray-100 flex justify-end gap-3 sticky bottom-0 bg-white pb-6">
                <button type="button" onclick="closeSidePage('modal-editar-acesso')" class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95 leading-none">
                    Atualizar Dados
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeSidePage(id) {
        const modal = document.getElementById(id);
        const content = modal.querySelector('#modal-content');
        const backdrop = modal.querySelector('#modal-backdrop');
        
        content.classList.remove('animate-slide-in-right');
        content.classList.add('animate-slide-out-right');
        backdrop.classList.add('opacity-0');
        
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
</script>

<style>
    @keyframes slideInRight {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { transform: translateX(0); }
        to { transform: translateX(100%); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-slide-in-right {
        animation: slideInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    .animate-slide-out-right {
        animation: slideOutRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>
