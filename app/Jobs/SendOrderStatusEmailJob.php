<?php

namespace App\Jobs;

use App\Models\Pedido;
use App\Services\MailService;
use Core\Queue\Job;

class SendOrderStatusEmailJob extends Job
{
    /**
     * Define o número de tentativas se o job falhar.
     */
    public int $tries = 3;

    /**
     * O tempo de espera (segundos) entre as tentativas.
     */
    public int $backoff = 60;

    private int $pedidoId;
    private string $status;

    public function __construct(int $pedidoId, string $status)
    {
        $this->pedidoId = $pedidoId;
        $this->status = $status;
    }

    /**
     * Local onde a mágica acontece.
     */
    public function handle(): void
    {
        $pedidoModel = new Pedido();
        $pedido = $pedidoModel->with('usuario')->where('id', '=', $this->pedidoId)->first();

        if (!$pedido || !$pedido->usuario || !$pedido->usuario->email) {
            return;
        }

        $usuario = $pedido->usuario;
        $mailService = app(MailService::class);

        $labels = [
            'aguardando' => 'Aguardando Aprovação',
            'separacao'  => 'Em Separação/Preparação',
            'saiu_entrega' => 'Saiu para Entrega',
            'entregue'   => 'Entregue com Sucesso',
            'cancelado'  => 'Cancelado'
        ];

        $statusLabel = $labels[$this->status] ?? $this->status;
        $subject = "Atualização do Pedido #{$pedido->id} - {$statusLabel}";
        
        $body = "<h2>Olá, {$usuario->nome}!</h2>";
        $body .= "<p>O status do seu pedido <strong>#{$pedido->id}</strong> foi atualizado para: <strong>{$statusLabel}</strong>.</p>";
        $body .= "<p>Acesse sua conta para mais detalhes.</p>";
        $body .= "<br><p>Atenciosamente,<br>Equipe Supermercado</p>";

        $mailService->send($usuario->email, $subject, $body);
    }
}
