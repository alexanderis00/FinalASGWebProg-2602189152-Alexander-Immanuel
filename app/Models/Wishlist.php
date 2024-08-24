<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wishlisted_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wishlistedUser()
    {
        return $this->belongsTo(User::class, 'wishlisted_user_id');
    }
}
