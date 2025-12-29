<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Message;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'created_by',
    ];

    protected $appends = [
        'avatar_url',
    ];

    // Avatar da sala
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/room-avatars/' . $this->avatar);
        }

        // fallback: iniciais da sala
        return 'https://ui-avatars.com/api/?name='
            . urlencode($this->name)
            . '&background=E5E7EB&color=374151';
    }

    // Criador da sala
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isAdmin(User $user): bool
    {
        return $this->created_by === $user->id || $user->isAdmin();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
