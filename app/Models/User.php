<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userable_type',
        'userable_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (User $user) {
            $user->userable->delete();
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    public function is_completed(): bool
    {
        return ! is_null($this->userable_id);
    }

    public function is_seeker(): bool
    {
        return $this->userable_type === 'App\Models\Seeker';
    }

    public function is_saloon(): bool
    {
        return $this->userable_type === 'App\Models\Saloon';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function authorship(): HasMany
    {
        return $this->hasMany(Review::class, 'author_id');
    }

    public function saves(): HasMany
    {
        return $this->hasMany(Save::class);
    }

    public function chats(): HasMany
    {
        return $this->userable->hasMany(Chat::class);
    }

    public function nonArchivedChats(): Collection
    {
        $column = $this->is_seeker() ? 'seeker_archived' : 'saloon_archived';
        return $this->chats()->where($column, false)->get();
    }

    public function archivedChats(): Collection
    {
        $column = $this->is_seeker() ? 'seeker_archived' : 'saloon_archived';
        return $this->chats()->where($column, true)->get();
    }

    public function in_chat(Chat $chat): bool
    {
        return ($this->is_seeker() && $chat->seeker->is($this->userable))
            || ($this->is_saloon() && $chat->saloon->is($this->userable));
    }

    public function unread_chats()
    {
        return DB::table('messages')
            ->where('receiver_id', $this->id)
            ->where('read', false)
            ->distinct()
            ->pluck('chat_id')
            ->toArray();
    }
}
