<?php

declare(strict_types=1);

namespace App\Mutators;

use Attribute;
use Core\Contracts\Mutator;

#[Attribute]
class NormalizaDatetime implements Mutator
{
    /**
     * Altera um valor de entrada antes dele ser encaminhado para o Banco de Dados.
     */
    public function mutate(string $attribute, mixed $value): mixed
    {
        if (!$value || !is_string($value)) {
            return $value;
        }

        // Converte "2025-03-10T14:30" → "2025-03-10 14:30:00"
        $dt = \DateTime::createFromFormat('Y-m-d\TH:i', $value);

        if (!$dt) {
            // Tenta com segundos também: "2025-03-10T14:30:00"
            $dt = \DateTime::createFromFormat('Y-m-d\TH:i:s', $value);
        }

        return $dt ? $dt->format('Y-m-d H:i:s') : $value;
    }
}
