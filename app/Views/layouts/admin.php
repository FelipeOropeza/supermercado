<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Supermercado | Admin Panel') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.8/dist/htmx.min.js" integrity="sha384-/TgkGk7p307TH7EXJDuUlgG3Ce1UVolAOFopFekQkkXihi5u/6OCvVKyz1W+idaz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
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

<body class="text-gray-800 min-h-screen flex flex-col md:flex-row antialiased">

    <!-- SIDEBAR -->
    <aside class="w-full md:w-64 bg-white border-r border-gray-200 min-h-screen flex flex-col sticky top-0 md:h-screen overflow-y-auto">
        <div class="p-6 border-b border-gray-100 flex items-center justify-center">
            <h1 class="text-2xl font-bold text-blue-600 tracking-tight">Manager<span class="text-gray-800">Pro</span></h1>
        </div>

        <nav class="flex flex-col flex-grow p-4 space-y-1">
            <a href="/admin" class="px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors <?= ($_SERVER['REQUEST_URI'] ?? '') === '/admin' ? 'bg-blue-50 text-blue-700' : 'text-gray-600' ?>">
                Dashboard
            </a>
            <a href="/admin/categorias" class="px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/categorias') !== false ? 'bg-blue-50 text-blue-700' : 'text-gray-600' ?>">
                Categorias
            </a>
            <a href="/admin/produtos" class="px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/produtos') !== false ? 'bg-blue-50 text-blue-700' : 'text-gray-600' ?>">
                Produtos
            </a>
            <a href="/admin/promocoes" class="px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/promocoes') !== false ? 'bg-blue-50 text-blue-700' : 'text-gray-600' ?>">
                Promoções
            </a>
            <a href="/admin/acessos" class="px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors <?= strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/acessos') !== false ? 'bg-blue-50 text-blue-700' : 'text-gray-600' ?>">
                Acessos
            </a>
        </nav>

        <div class="mt-auto border-t border-gray-100 p-4 shrink-0">
            <div class="flex items-center gap-3 px-4 py-3 mb-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">A</div>
                <div class="text-sm font-medium text-gray-700">Administrador</div>
            </div>
            <form action="/logout" method="POST">
                <button type="submit" class="w-full bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg py-2.5 px-4 hover:bg-gray-50 transition-colors shadow-sm">
                    Sair do Sistema
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <main class="flex-1 w-full relative h-[100dvh] overflow-y-auto overflow-x-hidden p-6 md:p-10 z-10 bg-gray-50">
        <?php $this->renderSection('content'); ?>
    </main>

</body>

</html>