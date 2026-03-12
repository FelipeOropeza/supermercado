<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Core\Console\Command;
use App\Models\Promocao;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class CheckPromotionsCommand extends Command
{
    /**
     * Como chamar no terminal: php forge promocoes:watch
     */
    protected string $signature = 'promocoes:watch';
    
    /**
     * O que aparece no 'php forge'
     */
    protected string $description = 'Monitora ativamente a validade das promoções e notifica o layout em tempo real (Worker).';

    public function handle(array $args): void
    {
        $this->info("Worker Iniciado: Monitorando transições de promoções (No ar, Agendada, Encerrada)...");

        $lastActiveIds = [];
        $hub = app(HubInterface::class);
        $primeiraBusca = true;

        while (true) {
            try {
                $today = date('Y-m-d H:i:s');
                
                // Busca TODAS as promoções que teoricamente devem estar "No Ar" agora
                $promocoesNoAr = (new Promocao())
                    ->where('data_inicio', '<=', $today)
                    ->where('data_fim', '>=', $today)
                    ->where('destaque_folheto', '=', '1')
                    ->get();
                    
                // Extrai apenas os IDs numéricos
                $currentActiveIds = array_map(fn($p) => $p->id, $promocoesNoAr);
                sort($currentActiveIds);
                
                // Ignora o evento na primeira vez que o script roda (apenas alimenta a memória)
                if ($primeiraBusca) {
                    $lastActiveIds = $currentActiveIds;
                    $primeiraBusca = false;
                    $this->line("ℹ️ [" . date('H:i:s') . "] Estado inicial carregado: " . count($currentActiveIds) . " promoções ativas.");
                    sleep(10);
                    continue;
                }
                
                // Compara com o estado anterior
                if ($lastActiveIds !== $currentActiveIds) {
                    $this->info("[" . date('H:i:s') . "] Mudança de Status Detectada! Atualizando clientes via Mercure...");
                    
                    // Dispara um evento global de atualização via Mercure usando o Helper
                    broadcast('supermercado/promocoes', ['action' => 'refresh', 'time' => time()]);
                    
                    $lastActiveIds = $currentActiveIds;
                    $this->line("✅ Notificação HTMX disparada com sucesso.");
                }
                
            } catch (\Throwable $e) {
                $this->error("Erro no Worker: " . $e->getMessage());
                sleep(5); // Em caso de queda do banco ou da conexão HTMX/Mercure
            }
            
            // Aguarda 10 segundos antes da próxima verificação
            sleep(10);
        }
    }
}
