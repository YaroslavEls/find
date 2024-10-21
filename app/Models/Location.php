<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Location extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'city',
        'address',
        'schedule',
        'gen',
        'photos',
        'video'
    ];

    protected static function booted(): void
    {
        static::deleting(function (Location $location) {
            foreach (explode(';', $location->photos) as $photo) {
                Storage::delete($photo);
            }
        });
    }

    public function saloon(): BelongsTo
    {
        return $this->belongsTo(Saloon::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
