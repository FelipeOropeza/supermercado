<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Product extends Model
{
    protected $table = 'products';
    protected array $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'regular_price',
        'stock',
        'unit_type',
        'image'
    ];

    public ?int $id = null;

    public ?int $category_id = null;

    #[Required]
    public ?string $name = null;

    #[Required]
    public ?string $slug = null;

    public ?string $description = null;

    #[Required]
    public ?float $regular_price = null;

    #[Required]
    public ?int $stock = 0;

    #[Required]
    public ?string $unit_type = 'unidade';

    public ?string $image = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
