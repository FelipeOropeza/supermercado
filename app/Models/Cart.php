<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Cart extends Model
{
    protected $table = 'carts';
    protected array $fillable = ['user_id'];

    public ?int $id = null;

    #[Required]
    public ?int $user_id = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}
