<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'job',
        'employment',
        'experience',
        'salary',
        'descr'
    ];

    protected $with = [
        'saloon:id,logo,name',
        'location:id,photos,city,address,gen'
    ];

    public function saloon(): BelongsTo
    {
        return $this->belongsTo(Saloon::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function saves(): MorphOne
    {
        return $this->morphOne(Save::class, 'savable');
    }
}
