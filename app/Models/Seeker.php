<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Seeker extends Model
{
    use HasFactory;

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
        'cv'
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function saves(): MorphOne
    {
        return $this->morphOne(Save::class, 'savable');
    }
}
