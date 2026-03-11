<!-- Modal Novo Acesso (Página Overlay) -->
<div id="modal-novo-acesso" 
     x-data="{ show: false }" 
     x-init="$nextTick(() => show = true)"
     x-show="show" 
     style="display: none;" 
     class="fixed inset-0 z-[60] flex justify-end">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm" 
         x-show="show" 
         x-transition.opacity.duration.300ms 
         @click="show = false; setTimeout(() => $root.remove(), 300)"></div>

    <!-- Content Card (Página Lateral) -->
    <div class="relative w-full max-w-2xl bg-white h-screen shadow-2xl overflow-y-auto flex flex-col"
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="translate-x-full" 
         x-transition:enter-end="translate-x-0" 
         x-transition:leave="transition ease-in duration-300 transform" 
         x-transition:leave-start="translate-x-0" 
         x-transition:leave-end="translate-x-full">

        <!-- Modal Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Novo Acesso Staff</h3>
                <p class="text-gray-500 text-sm">Cadastrar novas credenciais de equipe</p>
            </div>
            <button type="button" @click="show = false; setTimeout(() => $root.remove(), 300)" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <span class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('error') ?></span>
        <!-- Modal Body -->
        <form action="<?= route('admin.acessos.store') ?>" method="POST" class="p-8 flex-grow flex flex-col">
            <?= csrf_field() ?>
            <div class="space-y-6">

                <!-- Nome Completo -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nome Completo</label>
                    <input type="text" name="nome" value="<?= old('nome') ?>" placeholder="John Doe" class="w-full bg-gray-50 border <?= errors('nome') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all placeholder:text-gray-400">
                    <?php if (errors('nome')): ?>
                        <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('nome') ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- E-mail -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">E-mail Comercial</label>
                        <input type="email" name="email" value="<?= old('email') ?>" placeholder="nome@mercado.com.br" class="w-full bg-gray-50 border <?= errors('email') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('email')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('email') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- CPF -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">CPF</label>
                        <input type="text" name="cpf" value="<?= old('cpf') ?>" placeholder="000.000.000-00" class="w-full bg-gray-50 border <?= errors('cpf') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('cpf')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('cpf') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Telefone</label>
                        <input type="text" name="telefone" value="<?= old('telefone') ?>" placeholder="(00) 00000-0000" class="w-full bg-gray-50 border <?= errors('telefone') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('telefone')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('telefone') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nível de Acesso</label>
                        <div class="relative">
                            <select name="role" class="w-full bg-gray-50 border <?= errors('role') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all cursor-pointer appearance-none">
                                <option value="funcionario" <?= old('role') === 'funcionario' || !old('role') ? 'selected' : '' ?>>Funcionário</option>
                                <option value="gerente" <?= old('role') === 'gerente' ? 'selected' : '' ?>>Gerente</option>
                                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <?php if (errors('role')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('role') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Senha -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Senha Inicial</label>
                        <input type="password" name="senha" placeholder="••••••••" class="w-full bg-gray-50 border <?= errors('senha') ? 'border-red-500' : 'border-gray-200' ?> rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition-all">
                        <?php if (errors('senha')): ?>
                            <p class="text-red-500 text-[10px] mt-1.5 font-bold italic ml-1"><?= errors('senha') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="mt-auto pt-8 border-t border-gray-100 flex justify-end gap-3 sticky bottom-0 bg-white pb-6">
                <button type="button" @click="show = false; setTimeout(() => $root.remove(), 300)" class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95 leading-none">
                    Salvar Novo Membro
                </button>
            </div>
        </form>
    </div>
</div>
