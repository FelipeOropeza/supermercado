<?php

declare(strict_types=1);

namespace App\Rules;

use Attribute;
use Core\Contracts\ValidationRule;

#[Attribute]
class UniqueCepRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, array $allData = []): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        $usuarioId = session('user')['id'] ?? null;
        if (!$usuarioId) return null;

        $db = \Core\Database\Connection::getInstance();
        $sql = "SELECT id FROM enderecos WHERE usuario_id = :uid AND cep = :cep";

        // Se estivermos editando, precisamos ignorar o ID atual
        $id = $allData['id'] ?? null;
        if ($id) {
            $sql .= " AND id != :id";
        }

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':uid', $usuarioId);
        $stmt->bindValue(':cep', $value);
        if ($id) {
            $stmt->bindValue(':id', $id);
        }

        $stmt->execute();

        if ($stmt->fetch()) {
            return "Você já tem um endereço cadastrado com este CEP.";
        }

        return null;
    }
}
