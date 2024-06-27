<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'industry',
        'website',
        'logo',
        'about',
        'contact_info',

    ];

    protected $casts = [
        'contact_info' => 'array', // Cast the JSON column to an array for easier manipulation
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }
}
