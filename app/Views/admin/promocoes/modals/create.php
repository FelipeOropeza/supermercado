<?php
$isCreatingError = !empty(errors());
$produtosList = $produtosList ?? (new \App\Services\ProdutoService())->getAll();
?>
<div id="modal-nova-promocao" class="<?= $isCreatingError ? '' : 'hidden' ?> fixed inset-0 z-[60] bg-gray-900/40 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto">
    <div class="bg-white rounded-[2rem] w-full max-w-2xl shadow-2xl overflow-hidden my-auto animate-modal-entrance">
        
        <!-- Modal Header -->
        <div class="px-8 py-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <div class="flex items-center gap-4">
                <div class="bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-100 italic">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-gray-900 leading-none">Criar Nova Oferta</h3>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1 block">Configuração de Venda</span>
                </div>
            </div>
            <button onclick="document.getElementById('modal-nova-promocao').classList.add('hidden')" class="bg-white text-gray-400 hover:text-gray-900 transition-all p-2.5 rounded-xl shadow-sm border border-gray-100 hover:border-gray-200">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="<?= route('admin.promocoes.store') ?>" method="POST" class="p-8">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- LEFT COLUMN: Product & Highlight -->
                <div class="lg:col-span-12 space-y-8">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">1. Qual produto receberá o desconto?</label>
                        <div class="relative group">
                            <select name="produto_id" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 cursor-pointer appearance-none transition-all font-bold group-hover:bg-white">
                                <option value="">Selecione um item do estoque...</option>
                                <?php foreach ($produtosList as $produto): ?>
                                    <option value="<?= $produto->id ?>" <?= (old('produto_id') == $produto->id) ? 'selected' : '' ?>>
                                        <?= e($produto->nome) ?> (Preço Normal: R$ <?= number_format($produto->preco, 2, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 group-hover:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Scheduling Section -->
                        <div class="space-y-6 bg-blue-50/30 p-8 rounded-3xl border border-blue-50">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                <h4 class="text-sm font-black text-blue-900 uppercase">Validade do Timer</h4>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-blue-500 uppercase mb-2 ml-1">Início da Oferta</label>
                                <input type="datetime-local" name="data_inicio" value="<?= old('data_inicio') ?>" class="w-full bg-white border border-blue-100 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-blue-500 uppercase mb-2 ml-1">Fim da Validade</label>
                                <input type="datetime-local" name="data_fim" value="<?= old('data_fim') ?>" class="w-full bg-white border border-blue-100 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
                            </div>
                        </div>

                        <!-- Pricing & Highlight -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">2. Novo Preço Final</label>
                                <div class="relative group">
                                    <span class="absolute left-6 top-1/2 transform -translate-y-1/2 text-green-600 font-black text-xl">R$</span>
                                    <input type="number" step="0.01" name="preco_promocional" value="<?= old('preco_promocional') ?>" placeholder="0.00" class="w-full bg-white border-2 border-gray-100 rounded-3xl py-6 pl-16 pr-6 text-4xl font-black text-green-600 focus:outline-none focus:ring-8 focus:ring-green-500/5 focus:border-green-500 shadow-xl shadow-green-100/20 transition-all placeholder:text-green-100">
                                </div>
                            </div>
                            
                            <label class="flex items-center gap-4 cursor-pointer group bg-amber-50 p-6 rounded-3xl border-2 border-amber-100 hover:border-amber-200 transition-all">
                                <div class="relative">
                                    <input type="hidden" name="destaque_folheto" value="0">
                                    <input type="checkbox" name="destaque_folheto" value="1" <?= old('destaque_folheto') ? 'checked' : '' ?> class="peer sr-only">
                                    <div class="w-12 h-6 bg-amber-200 rounded-full peer-checked:bg-amber-500 transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-6"></div>
                                </div>
                                <div>
                                    <span class="block text-sm font-black text-amber-900 leading-tight">Capa de Destaque</span>
                                    <span class="block text-[10px] text-amber-700 font-bold uppercase tracking-tight opacity-70">Exibir no Banner da Home</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col md:flex-row justify-end gap-3 pt-6 border-t border-gray-50">
                <button type="button" onclick="document.getElementById('modal-nova-promocao').classList.add('hidden')" class="px-8 py-4 border-2 border-transparent text-gray-400 rounded-2xl hover:text-gray-900 font-bold transition-all text-sm uppercase tracking-widest">
                    Descartar
                </button>
                <button type="submit" class="px-10 py-4 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 font-black shadow-2xl shadow-blue-500/20 transition-all active:scale-95 text-sm uppercase tracking-widest flex items-center justify-center gap-3">
                    Agendar Oferta
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
