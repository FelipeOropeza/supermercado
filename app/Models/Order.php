<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Order extends Model
{
    protected $table = 'orders';
    protected array $fillable = [
        'user_id',
        'address_id',
        'total_amount',
        'status',
        'payment_method',
        'notes'
    ];

    public ?int $id = null;

    #[Required]
    public ?int $user_id = null;

    public ?int $address_id = null;

    #[Required]
    public ?float $total_amount = null;

    #[Required]
    public ?string $status = 'pendente';

    #[Required]
    public ?string $payment_method = 'dinheiro';

    public ?string $notes = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
