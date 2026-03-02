<?php

namespace App\Models;

use Core\Database\Model;
use Core\Attributes\Required;

class Address extends Model
{
    protected $table = 'addresses';
    protected array $fillable = [
        'user_id',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code'
    ];

    public ?int $id = null;

    #[Required]
    public ?int $user_id = null;

    #[Required]
    public ?string $street = null;

    #[Required]
    public ?string $number = null;

    public ?string $complement = null;

    #[Required]
    public ?string $neighborhood = null;

    #[Required]
    public ?string $city = null;

    #[Required]
    public ?string $state = null;

    #[Required]
    public ?string $zip_code = null;

    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
