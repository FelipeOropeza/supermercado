<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Supermercado | Admin Panel') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@2.0.2"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
        }

        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="text-gray-800 bg-[#F9FAFB] min-h-screen antialiased flex flex-col md:flex-row" x-data="{ mobileMenuOpen: false }">

    <!-- OVERLAY MOBILE -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[40] md:hidden"></div>

    <!-- HEADER MOBILE -->
    <header class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-[50]">
        <h1 class="text-xl font-bold text-blue-600 tracking-tight">Manager<span class="text-gray-900">Pro</span></h1>
        <button @click="mobileMenuOpen = true" class="p-2 text-gray-500 hover:bg-gray-100 rounded-xl transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </header>

    <!-- SIDEBAR -->
    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
           class="-translate-x-full md:translate-x-0 fixed md:sticky top-0 left-0 z-[50] w-72 h-screen bg-white border-r border-gray-100 flex flex-col transition-transform duration-300 ease-in-out shadow-2xl md:shadow-none">
        
        <!-- Logo (Desktop) -->
        <div class="p-8 hidden md:flex items-center">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter">Manager<span class="text-gray-900">Pro</span></h1>
        </div>

        <!-- Perfil Logado (Mobile Header inside sidebar) -->
        <div class="md:hidden p-6 border-b border-gray-50 flex items-center justify-between">
             <h1 class="text-lg font-bold text-blue-600">Menu</h1>
             <button @click="mobileMenuOpen = false" class="text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
             </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <?php 
            $role = session('user')['role'] ?? 'cliente'; 
            $currentUri = $_SERVER['REQUEST_URI'] ?? '';
            
            $links = [
                ['url' => '/admin', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />', 'active' => $currentUri === '/admin'],
                ['url' => '/admin/categorias', 'label' => 'Categorias', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />', 'active' => strpos($currentUri, '/admin/categorias') !== false],
                ['url' => '/admin/produtos', 'label' => 'Produtos', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />', 'active' => strpos($currentUri, '/admin/produtos') !== false],
            ];

            if (in_array($role, ['admin', 'gerente'])) {
                $links[] = ['url' => '/admin/promocoes', 'label' => 'Promoções', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />', 'active' => strpos($currentUri, '/admin/promocoes') !== false];
            }

            if ($role === 'admin') {
                $links[] = ['url' => '/admin/acessos', 'label' => 'Privilégios', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />', 'active' => strpos($currentUri, '/admin/acessos') !== false];
            }
            ?>

            <?php foreach ($links as $link): ?>
                <a href="<?= $link['url'] ?>" 
                   @click="mobileMenuOpen = false"
                   class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl text-[13px] font-bold transition-all duration-200 <?= $link['active'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <svg class="w-5 h-5 <?= $link['active'] ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?= $link['icon'] ?>
                    </svg>
                    <?= $link['label'] ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="p-4 bg-gray-50/50 m-4 rounded-3xl border border-gray-100/50">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-black text-sm shadow-inner shadow-white/20">
                    <?= strtoupper(session('user')['nome'][0] ?? 'S') ?>
                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] font-black text-gray-900 truncate max-w-[120px]"><?= e(session('user')['nome'] ?? 'Staff') ?></span>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest leading-none">
                        <?= [
                            'admin' => 'Administrador',
                            'gerente' => 'Gerente',
                            'funcionario' => 'Funcionário'
                        ][$role] ?? 'Staff' ?>
                    </span>
                </div>
            </div>
            
            <form action="/logout" method="POST">
                <button type="submit" class="w-full bg-white border border-gray-200 text-red-500 text-xs font-black uppercase tracking-widest rounded-xl py-3 px-4 hover:bg-red-50 hover:border-red-100 transition-all shadow-sm active:scale-95">
                    Sair da Conta
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <main class="flex-1 w-full min-h-screen relative p-4 sm:p-6 md:p-10 bg-gray-50">
        <?php $this->renderSection('content'); ?>
    </main>

</body>

</html>

</html>