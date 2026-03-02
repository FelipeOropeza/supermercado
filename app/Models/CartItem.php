<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected array $fillable = ['cart_id', 'product_id', 'quantity'];

    public ?int $id = null;

    #[Required]
    public ?int $cart_id = null;

    #[Required]
    public ?int $product_id = null;

    #[Required]
    public ?int $quantity = 1;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}
