<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Category extends Model
{
    protected $table = 'categories';
    protected array $fillable = ['name', 'slug', 'description'];

    public ?int $id = null;

    #[Required]
    public ?string $name = null;

    #[Required]
    public ?string $slug = null;

    public ?string $description = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
