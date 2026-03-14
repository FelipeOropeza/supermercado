<?php $this->layout('layouts/admin', ['title' => 'Gestão de Promoções - Admin']); ?>
<?php 
    $role = session('user')['role'] ?? 'cliente';
    if ($role === 'funcionario') { header('Location: /admin'); exit; }
?>

<div class="max-w-7xl mx-auto w-full">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Folheto de Promoções</h2>
            <p class="text-gray-500 text-sm mt-1.5 font-medium">Configure descontos agendados e produtos em destaque na vitrine principal.</p>
        </div>
        <?php if (in_array($role, ['admin', 'gerente'])): ?>
            <button x-data @click="$dispatch('open-modal-promocao')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md shadow-blue-100 transition-all duration-200 flex items-center gap-2 transform hover:-translate-y-0.5 active:scale-95">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Agendar Nova Oferta
            </button>
        <?php endif; ?>
    </div>

    <!-- Status Legend & Filters (Optional but nice for UX) -->
    <div class="flex flex-wrap gap-4 mb-6">
        <div class="flex items-center gap-6 text-xs font-bold text-gray-400 uppercase tracking-widest bg-white/50 px-4 py-2 rounded-lg border border-gray-100">
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-green-500 shadow-sm shadow-green-200"></span> No Ar</span>
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm shadow-amber-200"></span> Agendada</span>
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-gray-300 shadow-sm shadow-gray-100"></span> Encerrada</span>
        </div>
    </div>

    <!-- Main List (Desktop Table & Mobile Cards via Component) -->
    <div id="promocoes-container">
        <?php include __DIR__ . '/../../components/promocoes_admin_table.php'; ?>
    </div>

    <!-- Modal: Agendar Promoção -->
    <?= $this->include('admin/promocoes/modals/create') ?>
</div>


