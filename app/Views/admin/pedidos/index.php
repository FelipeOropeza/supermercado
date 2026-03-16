<?php $this->layout('layouts/admin', ['title' => 'Logística - Kanban', 'hideSidebar' => true]); ?>

<?php $this->section('content'); ?>
<div class="h-screen flex flex-col bg-gray-50">
    <!-- Clean Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex flex-col gap-4 shrink-0">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/admin" class="p-2 text-gray-400 hover:text-blue-600 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <h1 class="text-xl font-bold text-gray-900 tracking-tight">Logística de Pedidos</h1>
            </div>
            
            <!-- Filter Bar -->
            <form 
                hx-get="/admin/pedidos" 
                hx-target="#kanban-container" 
                hx-trigger="keyup from:#search-input delay:500ms, change from:select, change from:input[type=date]"
                class="flex items-center gap-3"
            >
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        id="search-input"
                        placeholder="Buscar por ID ou Cliente..." 
                        class="bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none w-64 transition-all"
                    >
                </div>

                <input 
                    type="date" 
                    name="date" 
                    value="<?= date('Y-m-d') ?>"
                    class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"
                >

                <select 
                    name="status" 
                    class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"
                >
                    <option value="">Todos os Status</option>
                    <option value="aguardando">Aguardando</option>
                    <option value="separacao">Em Separação</option>
                    <option value="saiu_entrega">Saiu para Entrega</option>
                    <option value="entregue">Entregue</option>
                </select>

                <button type="button" onclick="window.location.reload()" class="p-2 text-gray-400 hover:text-blue-600 rounded-lg transition-colors" title="Atualizar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
            </form>
        </div>
    </header>

    <!-- Kanban Board Container -->
    <div class="flex-1 overflow-x-auto p-6" id="kanban-container">
        <?php echo view('admin/pedidos/kanban', ['pedidos' => $pedidos]); ?>
    </div>
</div>
<?php $this->endSection(); ?>
