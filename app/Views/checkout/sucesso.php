<?php $this->layout('layouts/main', ['title' => $title]); ?>

<?php $this->section('content'); ?>
<main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-32 sm:py-48 flex flex-col items-center text-center">
    <div class="mb-12 relative">
        <!-- Badge Animada de Sucesso -->
        <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center relative z-10">
            <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping opacity-20"></div>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-emerald-950 tracking-[-0.04em] leading-none mb-6">
        Pedido Realizado!
    </h1>
    
    <p class="text-gray-500 text-lg sm:text-xl max-w-xl font-medium mb-12">
        Obrigado pela sua compra. Seu pedido <span class="text-emerald-900 font-bold">#<?= str_pad((string)$pedidoId, 6, '0', STR_PAD_LEFT) ?></span> foi recebido e já estamos preparando os itens para você.
    </p>

    <div class="flex flex-col sm:flex-row items-center gap-4">
        <a href="/" class="w-full sm:w-auto py-5 px-10 bg-emerald-950 text-white text-xs font-black uppercase tracking-[0.2em] rounded-sm btn-premium shadow-xl shadow-emerald-900/10">
            Continuar Comprando
        </a>
        <a href="<?= route('minha-conta') ?>" class="w-full sm:w-auto py-5 px-10 border border-gray-100 text-emerald-950 text-xs font-black uppercase tracking-[0.2em] rounded-sm hover:bg-gray-50 transition-all">
            Ver Meus Pedidos
        </a>
    </div>

    <p class="mt-16 text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em] animate-pulse">
        Acompanhe o status no seu perfil
    </p>
</main>
<?php $this->endSection(); ?>
