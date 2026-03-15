<?php $this->layout('layouts/main', ['title' => 'Meu Carrinho | Supermercado']); ?>

<?php $this->section('content'); ?>
<section class="bg-[#f9fafb] border-b border-gray-100 py-12 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-6xl font-extrabold text-emerald-950 tracking-[-0.03em] leading-none mb-4">
            Meu Carrinho
        </h1>
        <p class="text-gray-500 text-lg sm:text-xl max-w-2xl font-medium">Revise seus itens antes de prosseguir para o checkout.</p>
    </div>
</section>

<main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <div id="cart-content" class="transition-all duration-300">
        <?php include __DIR__ . '/partials/cart_table.php'; ?>
    </div>
</main>
<?php $this->endSection(); ?>
