<div id="grid-produtos" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
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
