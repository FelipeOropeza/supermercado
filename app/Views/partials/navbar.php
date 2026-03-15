<!-- Navbar Premium Minimal -->
<?php 
    $uri = $_SERVER['REQUEST_URI'] ?? '/'; 
    $isHome = ($uri == '/' || $uri == '');
    $isProdutos = str_contains($uri, '/produtos') || str_contains($uri, '/categoria');
    $cartCount = session()->has('user') ? app(\App\Services\CarrinhoService::class)->getCartCount(session('user')['id']) : 0;
?>

<nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300" id="main-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="/" class="group flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-900 rounded-sm flex items-center justify-center text-white text-xl transition-transform group-hover:scale-110">
                        🛒
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-emerald-950 leading-none tracking-tight">SUPERMERCADO</span>
                        <span class="text-[10px] text-emerald-600 font-bold tracking-[0.2em] uppercase mt-1">Digital & Fresco</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="/" class="<?= $isHome ? 'text-emerald-950 font-bold' : 'text-gray-500 hover:text-emerald-800' ?> text-sm font-medium transition-colors">
                    Promoções
                </a>
                <a href="/produtos" class="<?= $isProdutos ? 'text-emerald-950 font-bold' : 'text-gray-500 hover:text-emerald-800' ?> text-sm font-medium transition-colors">
                    Todos os Produtos
                </a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Cart -->
                <a href="<?= route('carrinho') ?>" class="relative p-2.5 text-gray-700 hover:bg-gray-50 rounded-sm transition-colors group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <?php include __DIR__ . '/../carrinho/partials/cart_badge.php'; ?>
                </a>

                <!-- User Profile / Auth -->
                <div class="hidden sm:flex items-center pl-4 border-l border-gray-100 gap-4">
                    <?php if (session()->has('user')): ?>
                        <div class="flex flex-col items-end mr-2">
                            <span class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider"><?= htmlspecialchars(session('user')['role'] ?? 'Cliente') ?></span>
                            <span class="text-sm font-bold text-emerald-950 leading-none"><?= htmlspecialchars(explode(' ', session('user')['nome'])[0]) ?></span>
                        </div>
                        <a href="<?= route('minha-conta') ?>" class="p-2.5 text-gray-700 hover:bg-gray-50 rounded-sm transition-colors border border-transparent hover:border-gray-100" title="Minha Conta">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>

                        <form action="<?= route('logout') ?>" method="POST" class="inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="p-2.5 text-red-500 hover:bg-red-50 rounded-sm transition-colors border border-transparent hover:border-red-100" title="Sair">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?= route('login') ?>" class="text-sm font-bold text-emerald-950 hover:text-emerald-700 transition-colors">Entrar</a>
                        <a href="<?= route('register') ?>" class="bg-emerald-900 text-white px-5 py-2.5 rounded-sm text-sm font-bold hover:bg-emerald-800 transition-all shadow-sm">Criar Conta</a>
                    <?php endif; ?>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <button type="button" 
                        onclick="toggleMobileMenu()"
                        class="md:hidden p-2.5 text-emerald-950 hover:bg-emerald-50 rounded-sm transition-colors" 
                        aria-controls="mobile-menu" 
                        aria-expanded="false">
                    <span class="sr-only">Abrir menu</span>
                    <svg id="menu-icon-open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="menu-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Drawer -->
    <div class="md:hidden hidden bg-white border-t border-gray-50 overflow-hidden transition-all duration-300 ease-in-out" id="mobile-menu">
        <div class="px-4 pt-4 pb-8 space-y-1">
            <a href="/" class="block px-4 py-4 rounded-sm text-base font-bold <?= $isHome ? 'bg-emerald-50 text-emerald-900 border-l-4 border-emerald-900' : 'text-gray-600 hover:bg-gray-50' ?> transition-all">
                Promoções
            </a>
            <a href="/produtos" class="block px-4 py-4 rounded-sm text-base font-bold <?= $isProdutos ? 'bg-emerald-50 text-emerald-900 border-l-4 border-emerald-900' : 'text-gray-600 hover:bg-gray-50' ?> transition-all">
                Produtos
            </a>
            
            <div class="pt-6 pb-2 border-t border-gray-50 mt-4">
                <?php if (session()->has('user')): ?>
                    <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Minha Conta</p>
                    <a href="<?= route('minha-conta') ?>" class="block px-4 py-3 rounded-sm text-base font-medium text-gray-600 hover:bg-gray-50">Configurações</a>
                    <form action="<?= route('logout') ?>" method="POST" class="block w-full">
                        <?= csrf_field() ?>
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-sm text-base font-medium text-red-600 hover:bg-red-50">Sair</button>
                    </form>
                <?php else: ?>
                    <div class="grid grid-cols-2 gap-4 px-4 mt-4">
                        <a href="<?= route('login') ?>" class="flex items-center justify-center px-4 py-3 rounded-sm border border-gray-200 text-sm font-bold text-emerald-950">Entrar</a>
                        <a href="<?= route('register') ?>" class="flex items-center justify-center px-4 py-3 rounded-sm bg-emerald-900 text-sm font-bold text-white shadow-sm">Cadastrar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-icon-open');
        const closeIcon = document.getElementById('menu-icon-close');
        const isHidden = menu.classList.contains('hidden');

        if (isHidden) {
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.style.maxHeight = '1000px';
                menu.style.opacity = '1';
            }, 10);
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        } else {
            menu.style.maxHeight = '0px';
            menu.style.opacity = '0';
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 300);
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }

    // Shadow on scroll
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('main-nav');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-xl', 'shadow-emerald-900/5');
            nav.querySelector('.max-w-7xl').classList.remove('h-20');
            nav.querySelector('.max-w-7xl').classList.add('h-16');
        } else {
            nav.classList.remove('shadow-xl', 'shadow-emerald-900/5');
            nav.querySelector('.max-w-7xl').classList.remove('h-16');
            nav.querySelector('.max-w-7xl').classList.add('h-20');
        }
    });
</script>