<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected array $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price'
    ];

    public ?int $id = null;

    #[Required]
    public ?int $order_id = null;

    #[Required]
    public ?int $product_id = null;

    #[Required]
    public ?int $quantity = null;

    #[Required]
    public ?float $unit_price = null;

    #[Required]
    public ?float $total_price = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
