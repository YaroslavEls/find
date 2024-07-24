<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Save extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function seekers(): MorphToMany
    // {
    //     return $this->morphedByMany(Seeker::class, 'savable');
    // }

    public function savable(): MorphTo
    {
        return $this->morphTo();
    }
}
