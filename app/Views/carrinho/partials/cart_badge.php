<span id="cart-count-badge" 
      hx-get="/carrinho/count" 
      hx-trigger="cart-updated from:body" 
      hx-swap="outerHTML"
      class="absolute top-1 right-1 flex h-4 w-4">
    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
    <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-600 text-[10px] font-bold text-white items-center justify-center">
        <?= $cartCount ?>
    </span>
</span>
