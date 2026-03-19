<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
    <?php foreach ($produtos as $produto): ?>
        <?php $this->include('components/produto_card', ['produto' => $produto]); ?>
    <?php endforeach; ?>
    
    <?php if (empty($produtos)): ?>
        <div class="col-span-full py-32 text-center animate-fade-in">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-bold text-gray-800">Nenhum produto encontrado</h3>
            <p class="text-gray-500 mt-1">Tente ajustar seus filtros ou buscar por outro termo.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Paginação -->
<?php if (isset($paginacao) && $paginacao['last_page'] > 1): ?>
    <?php 
        $queryParams = $_GET; 
        unset($queryParams['page']); // Limpa pra re-adicionar
        $baseUrl = explode('?', $_SERVER['REQUEST_URI'])[0] . '?' . http_build_query($queryParams);
    ?>
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 py-6 sm:px-0 mt-8">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Mostrando <span class="font-medium"><?= $paginacao['from'] ?></span> até <span class="font-medium"><?= $paginacao['to'] ?></span> de <span class="font-medium"><?= $paginacao['total'] ?></span> resultados
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end gap-3">
            <?php if ($paginacao['current_page'] > 1): ?>
                <a href="<?= $baseUrl ?>&page=<?= $paginacao['current_page'] - 1 ?>" 
                    hx-get="<?= $baseUrl ?>&page=<?= $paginacao['current_page'] - 1 ?>"
                    hx-target="#grid-container"
                    hx-push-url="true"
                    hx-swap="innerHTML show:window:top"
                    class="relative inline-flex items-center rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0 transition-all">
                    Anterior
                </a>
            <?php endif; ?>
            
            <?php if ($paginacao['current_page'] < $paginacao['last_page']): ?>
                <a href="<?= $baseUrl ?>&page=<?= $paginacao['current_page'] + 1 ?>" 
                    hx-get="<?= $baseUrl ?>&page=<?= $paginacao['current_page'] + 1 ?>"
                    hx-target="#grid-container"
                    hx-push-url="true"
                    hx-swap="innerHTML show:window:top"
                    class="relative inline-flex items-center rounded-xl bg-green-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-all">
                    Próxima
                </a>
            <?php endif; ?>
        </div>
    </nav>
<?php endif; ?>
