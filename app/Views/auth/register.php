<?php $this->layout('layouts/main', ['title' => 'Criar Conta | Supermercado']); ?>

<?php $this->section('content'); ?>
<main class="flex-grow flex items-center justify-center px-4 py-12 bg-gray-50">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 w-full max-w-lg my-8">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Criar Nova Conta</h2>
            <p class="text-gray-500 text-sm mt-2">Junte-se a nós e aproveite ofertas exclusivas!</p>
        </div>

        <form action="/register" method="POST" class="space-y-5">
            <?= csrf_field() ?? '' ?>

            <!-- Nome -->
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="nome">Nome Completo</label>
                <input class="w-full px-4 py-3 rounded-lg border <?= errors('nome') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="nome" type="text" name="nome" value="<?= e(old('nome')) ?>" placeholder="João Silva" required>
                <?php if ($error = errors('nome')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">E-mail</label>
                <input class="w-full px-4 py-3 rounded-lg border <?= errors('email') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="email" type="email" name="email" value="<?= e(old('email')) ?>" placeholder="voce@exemplo.com" required>
                <?php if ($error = errors('email')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
            </div>

            <!-- CPF e Telefone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="cpf">CPF <span class="text-gray-400 font-normal">(Opcional)</span></label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('cpf') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="cpf" type="text" name="cpf" value="<?= e(old('cpf')) ?>" placeholder="000.000.000-00">
                    <?php if ($error = errors('cpf')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="telefone">Telefone <span class="text-gray-400 font-normal">(Opcional)</span></label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('telefone') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="telefone" type="text" name="telefone" value="<?= e(old('telefone')) ?>" placeholder="(11) 90000-0000">
                    <?php if ($error = errors('telefone')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>
            </div>

            <!-- Senhas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="senha">Senha</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('senha') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="senha" type="password" name="senha" required>
                    <?php if ($error = errors('senha')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="senha_confirmacao">Confirme a Senha</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('senha_confirmacao') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="senha_confirmacao" type="password" name="senha_confirmacao" required>
                    <?php if ($error = errors('senha_confirmacao')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>
            </div>

            <div class="pt-4">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-green-200 transition transform hover:-translate-y-0.5" type="submit">
                    Criar Minha Conta
                </button>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    <a href="/login" class="text-green-600 font-semibold hover:text-green-800 hover:underline transition">Já possui conta? Faça o Login</a>
                </p>
            </div>
        </form>
    </div>
</main>
<?php $this->endSection(); ?>