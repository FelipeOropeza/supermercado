<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;
use Core\Attributes\Email;
use Core\Attributes\IsFloat;
use Core\Attributes\Min;
use Core\Attributes\Hash;

class User extends Model
{
    protected $table = 'users';
    protected array $fillable = ['name', 'email', 'password', 'phone', 'role'];

    // Propriedades publicas mapeando as colunas da tabela "users"
    public ?int $id = null;

    #[Required]
    public ?string $name = null;

    #[Required]
    #[Email]
    public ?string $email = null;

    #[Required]
    #[Min(8)]
    #[Hash]
    public ?string $password = null;

    public ?string $phone = null;

    #[Required]
    public ?string $role = 'client';

    public ?string $created_at = null;
    public ?string $updated_at = null;
}
