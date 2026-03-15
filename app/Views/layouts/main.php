<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Supermercado Online') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.8/dist/htmx.min.js" integrity="sha384-/TgkGk7p307TH7EXJDuUlgG3Ce1UVolAOFopFekQkkXihi5u/6OCvVKyz1W+idaz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php $this->include('partials/navbar'); ?>

    <!-- Content Section -->
    <?php $this->renderSection('content'); ?>

    <?php $this->include('partials/footer'); ?>

    <!-- Custom Scripts -->
    <?php $this->renderSection('scripts'); ?>

    <?= mercure_listen('supermercado/produtos', 'refresh-products') ?>
    <?= mercure_listen('supermercado/categorias', 'refresh-categorias') ?>

    <script>
        // Listener para Produtos
        document.body.addEventListener('refresh-products', (e) => {
            const { action, id } = e.detail;
            console.log("Evento Produto:", action, id);

            if (action === 'deleted') {
                const el = document.getElementById('produto-card-' + id);
                if (el) {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '0';
                    el.style.transform = 'scale(0.9) translateY(20px)';
                    setTimeout(() => el.remove(), 550);
                }
            } else if (action === 'restored' || action === 'created' || action === 'updated') {
                location.reload();
            }
        });

        // Listener para Categorias
        document.body.addEventListener('refresh-categorias', (e) => {
            const { action, id } = e.detail;
            console.log("Evento Categoria:", action, id);

            if (action === 'deleted') {
                const el = document.getElementById('categoria-section-' + id);
                if (el) {
                    el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.maxHeight = el.scrollHeight + 'px';
                    setTimeout(() => {
                        el.style.maxHeight = '0';
                        el.style.marginBottom = '0';
                        el.style.paddingTop = '0';
                        el.style.paddingBottom = '0';
                    }, 50);
                    setTimeout(() => el.remove(), 700);
                }
            } else if (action === 'restored') {
                location.reload();
            }
        });
    </script>
</body>

</html>