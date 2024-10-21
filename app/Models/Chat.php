<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chat extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'saloon_id',
        'seeker_id',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function saloon(): BelongsTo
    {
        return $this->belongsTo(Saloon::class, 'saloon_id');
    }
 
    public function seeker(): BelongsTo
    {
        return $this->belongsTo(Seeker::class, 'seeker_id');
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }
}
