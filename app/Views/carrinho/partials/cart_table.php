<?php if (empty($itens)): ?>
    <div class="py-20 text-center border-2 border-dashed border-gray-100 rounded-sm">
        <div class="text-4xl mb-6 opacity-30">🛒</div>
        <p class="text-gray-400 font-medium text-lg">Seu carrinho está vazio.</p>
        <a href="/" class="text-emerald-600 font-bold hover:underline mt-4 inline-block">Voltar para as compras</a>
    </div>
<?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="py-4 font-black text-xs uppercase tracking-widest text-emerald-950">Produto</th>
                    <th class="py-4 font-black text-xs uppercase tracking-widest text-emerald-950 text-center">Quantidade</th>
                    <th class="py-4 font-black text-xs uppercase tracking-widest text-emerald-950 text-right">Subtotal</th>
                    <th class="py-4"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($itens as $item): 
                    $produto = $item->produto;
                    $precoAtivo = $produto->preco;
                    
                    // Busca promoção ativa para exibição correta no carrinho
                    $today = date('Y-m-d H:i:s');
                    $db = \Core\Database\Connection::getInstance();
                    $stmt = $db->prepare("SELECT preco_promocional FROM promocoes WHERE produto_id = ? AND data_inicio <= ? AND data_fim >= ? LIMIT 1");
                    $stmt->execute([$produto->id, $today, $today]);
                    $promo = $stmt->fetch(\PDO::FETCH_ASSOC);
                    
                    if ($promo) {
                        $precoAtivo = $promo['preco_promocional'];
                    }
                    
                    $subtotal = $precoAtivo * $item->quantidade;
                    $total += $subtotal;
                ?>
                    <tr class="border-b border-gray-50 group">
                        <td class="py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gray-50 rounded-sm border border-gray-100 flex items-center justify-center text-2xl overflow-hidden p-2">
                                    <?php if (!empty($produto->imagem_url)): ?>
                                        <img src="<?= storage_url($produto->imagem_url) ?>" alt="<?= htmlspecialchars($produto->nome) ?>" class="w-full h-full object-contain">
                                    <?php else: ?>
                                        📦
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h4 class="font-bold text-emerald-950 text-sm leading-tight mb-1"><?= htmlspecialchars($produto->nome) ?></h4>
                                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">R$ <?= number_format($precoAtivo, 2, ',', '.') ?> un.</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-6">
                            <div class="flex items-center justify-center gap-3">
                                <form hx-post="/carrinho/update/<?= $produto->id ?>" hx-target="#cart-content" class="flex items-center bg-gray-50 rounded-sm border border-gray-100">
                                    <input type="hidden" name="quantidade" value="<?= $item->quantidade - 1 ?>">
                                    <button type="submit" class="p-2 text-gray-400 hover:text-emerald-900 transition-colors disabled:opacity-30" <?= $item->quantidade <= 1 ? 'disabled' : '' ?>>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4" stroke-width="2" stroke-linecap="round"/></svg>
                                    </button>
                                </form>
                                <span class="text-sm font-black text-emerald-950 w-6 text-center"><?= $item->quantidade ?></span>
                                <form hx-post="/carrinho/update/<?= $produto->id ?>" hx-target="#cart-content" class="flex items-center bg-gray-50 rounded-sm border border-gray-100">
                                    <input type="hidden" name="quantidade" value="<?= $item->quantidade + 1 ?>">
                                    <button type="submit" class="p-2 text-gray-400 hover:text-emerald-900 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="py-6 text-right">
                            <span class="font-black text-emerald-950 text-base tracking-tighter">R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                        </td>
                        <td class="py-6 text-right pl-4">
                            <form hx-post="/carrinho/remove/<?= $produto->id ?>" hx-target="#cart-content" hx-confirm="Deseja remover este item?">
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Resumo do Carrinho -->
    <div class="mt-12 flex flex-col items-end border-t border-gray-100 pt-12">
        <div class="w-full sm:w-72">
            <div class="flex justify-between items-baseline mb-6">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total do Pedido</span>
                <span class="text-3xl font-black text-emerald-950 tracking-tighter">R$ <?= number_format($total, 2, ',', '.') ?></span>
            </div>
            <a href="/checkout" class="flex items-center justify-center w-full py-5 px-8 bg-emerald-950 text-white text-xs font-black uppercase tracking-[0.2em] rounded-sm btn-premium shadow-xl shadow-emerald-900/10">
                Finalizar Compra
            </a>
            <p class="text-[10px] text-gray-400 text-center mt-6 font-medium leading-relaxed">
                Ao finalizar, você poderá escolher o endereço de entrega e o método de pagamento.
            </p>
        </div>
    </div>
<?php endif; ?>
