<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Seeker extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'birthday',
        'photo',
        'job',
        'experience',
        'salary',
        'city',
        'employment',
        'info',
        'cv',
        'active'
    ];

    protected static function booted(): void
    {
        static::deleting(function (Seeker $seeker) {
            Storage::delete($seeker->photo);
        });
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function saves(): MorphOne
    {
        return $this->morphOne(Save::class, 'savable');
    }
}
