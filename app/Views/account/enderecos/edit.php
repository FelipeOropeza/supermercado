<?php $this->layout('layouts/main', ['title' => 'Editar Endereço | Supermercado']); ?>

<?php $this->section('content'); ?>
<main class="flex-grow max-w-3xl mx-auto w-full px-4 sm:px-6 py-10">

    <div class="mb-6 flex items-center gap-4">
        <a href="/minha-conta" class="p-2 border border-gray-200 rounded-full hover:bg-gray-50 flex items-center justify-center text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Editar Endereço</h1>
            <p class="text-gray-500 text-sm">Atualize os dados para entrega.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="<?= route('enderecos.update', ['id' => $endereco->id]) ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?? '' ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-1">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="cep">CEP</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('cep') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="cep" type="text" name="cep" value="<?= htmlspecialchars(old('cep', $endereco->cep)) ?>" placeholder="00000000" required>
                    <?php if ($error = errors('cep')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="rua">Logradouro (Rua, Avenida)</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('rua') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="rua" type="text" name="rua" value="<?= htmlspecialchars(old('rua', $endereco->rua)) ?>" placeholder="Ex: Rua das Flores" required>
                    <?php if ($error = errors('rua')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="md:col-span-1">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="numero">Número</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('numero') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="numero" type="text" name="numero" value="<?= htmlspecialchars(old('numero', $endereco->numero)) ?>" placeholder="Ex: 123" required>
                    <?php if ($error = errors('numero')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="complemento">Complemento <span class="text-gray-400 font-normal">(Opcional)</span></label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition" id="complemento" type="text" name="complemento" value="<?= htmlspecialchars(old('complemento', $endereco->complemento)) ?>" placeholder="Apto, Bloco, Referência">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="bairro">Bairro</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('bairro') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="bairro" type="text" name="bairro" value="<?= htmlspecialchars(old('bairro', $endereco->bairro)) ?>" required>
                    <?php if ($error = errors('bairro')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="cidade">Cidade</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('cidade') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="cidade" type="text" name="cidade" value="<?= htmlspecialchars(old('cidade', $endereco->cidade)) ?>" required>
                    <?php if ($error = errors('cidade')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="estado">Estado (UF)</label>
                    <input class="w-full px-4 py-3 rounded-lg border <?= errors('estado') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent' ?> transition" id="estado" type="text" name="estado" value="<?= htmlspecialchars(old('estado', $endereco->estado)) ?>" placeholder="SP" maxlength="2" required>
                    <?php if ($error = errors('estado')): ?><p class="text-red-500 text-xs mt-1 font-medium"><?= $error ?></p><?php endif; ?>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="/minha-conta" class="px-6 py-3 border border-gray-300 text-gray-700 items-center justify-center font-semibold rounded-xl hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-green-200 transition transform hover:-translate-y-0.5">
                    Atualizar Endereço
                </button>
            </div>
        </form>
    </div>
</main>
<?php $this->endSection(); ?>