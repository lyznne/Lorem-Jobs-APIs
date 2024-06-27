<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jobs extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'location',
        'schedule',
        'deadline',
        'posted_at',
        'status',
        'description',
        'salary',
        'is_featured',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function featuredJob(): HasOne
    {
        return $this->hasOne(FeaturedJob::class);
    }
}
