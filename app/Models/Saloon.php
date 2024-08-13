<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Saloon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descr',
        'logo',
        'socials'
    ];

    protected static function booted(): void
    {
        static::deleting(function (Saloon $saloon) {
            Storage::delete($saloon->logo);

            foreach ($saloon->locations as $location) {
                foreach (explode(';', $location->photos) as $photo) {
                    Storage::delete($photo);
                }
            }
        });
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
