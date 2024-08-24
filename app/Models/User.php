<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'gender',
        'hobby',
        'email', 
        'phone', 
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friends', 'user_id', 'friend_id');
    }

    public function addFriend(User $user)
    {
        return $this->friends()->attach($user->id);
    }

    public function removeFriend(User $user)
    {
        return $this->friends()->detach($user->id);
    }

}
