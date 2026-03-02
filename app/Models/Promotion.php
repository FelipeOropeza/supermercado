<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected array $fillable = ['product_id', 'discount_price', 'start_date', 'end_date'];

    public ?int $id = null;

    #[Required]
    public ?int $product_id = null;

    #[Required]
    public ?float $discount_price = null;

    #[Required]
    public ?string $start_date = null;

    #[Required]
    public ?string $end_date = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
