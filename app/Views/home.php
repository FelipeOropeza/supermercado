<?php $this->layout('layouts/main', ['title' => 'Início | Supermercado']); ?>

<?php $this->section('content'); ?>
<!-- Hero Section Premium Minimal -->
<section class="relative overflow-hidden bg-[#f9fafb] pt-16 pb-20 sm:pt-24 sm:pb-32 border-b border-gray-100">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 blur-3xl opacity-20 pointer-events-none">
        <div class="w-96 h-96 rounded-full bg-emerald-500"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm bg-emerald-50 border border-emerald-100 mb-6 sm:mb-8">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-widest">Ofertas 24h Disponíveis</span>
            </div>

            <h1 class="text-5xl sm:text-7xl font-extrabold text-emerald-950 tracking-[-0.03em] leading-[0.95] mb-8">
                O frescor do campo <br/>
                <span class="text-emerald-600">na sua mesa digital.</span>
            </h1>

            <p class="text-lg sm:text-xl text-gray-500 max-w-xl leading-relaxed mb-10">
                Qualidade de mercado físico com o conforto do digital. Selecionamos os melhores produtos para que você não precise se preocupar com nada.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#folheto" class="btn-premium px-10 py-5 bg-emerald-900 text-white font-bold rounded-sm shadow-xl shadow-emerald-900/10 inline-flex items-center justify-center gap-3">
                    Explorar Ofertas
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </a>
                <a href="/produtos" class="btn-premium px-10 py-5 bg-white border border-gray-200 text-emerald-950 font-bold rounded-sm inline-flex items-center justify-center hover:bg-gray-50">
                    Ver Catálogo Total
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Seção: Ofertas -->
<main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div class="max-w-2xl">
            <h2 id="folheto" class="text-3xl sm:text-5xl font-extrabold text-emerald-950 tracking-tight mb-4 flex items-center gap-4">
                Folheto de Ofertas
            </h2>
            <p class="text-gray-500 text-lg">Produtos frescos e selecionados com preços reduzidos esta semana.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="h-1 w-20 bg-emerald-900 rounded-full"></div>
            <span class="text-xs font-bold text-emerald-900 uppercase tracking-widest">Atualizado Agora</span>
        </div>
    </div>

    <!-- Grid de Produtos Reativo (Somente Promoções) -->
    <div class="relative">
         <?php include __DIR__ . '/components/promocoes_grid.php'; ?>
    </div>
</main>
<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<script>
    // Smooth scroll para âncoras
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
<?php $this->endSection(); ?>