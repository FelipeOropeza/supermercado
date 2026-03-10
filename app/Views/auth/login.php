<?php $this->layout('layouts/main', ['title' => 'Entrar | Supermercado']); ?>

<?php $this->section('content'); ?>
<main class="flex-grow flex items-center justify-center px-4 py-12 bg-gray-50">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 w-full max-w-md">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Bem-vindo de volta!</h2>
            <p class="text-gray-500 text-sm mt-2">Acesse sua conta para continuar suas compras.</p>
        </div>

        <?php if ($error = errors('email')): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm" role="alert">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-5">
            <?= csrf_field() ?? '' ?>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">E-mail</label>
                <div class="relative">
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" id="email" type="email" name="email" value="<?= e(old('email')) ?>" placeholder="Seu email cadastrado" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="senha">Senha</label>
                <div class="relative">
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" id="senha" type="password" name="senha" placeholder="Sua senha secreta" required>
                </div>
            </div>

            <div class="pt-2">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-green-200 transition transform hover:-translate-y-0.5" type="submit">
                    Fazer Login
                </button>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">Ainda não tem conta? <br>
                    <a href="/register" class="text-green-600 font-semibold hover:text-green-800 hover:underline transition">Cadastre-se rapidinho</a>
                </p>
            </div>
        </form>
    </div>
</main>
<?php $this->endSection(); ?>