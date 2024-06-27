<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JWTToken extends Model
{
    use HasFactory;

    protected $table = 'jwt_tokens';

    protected $fillable = [
        'user_id', 'unique_id', 'token_title', 'restrictions', 'permissions', 'expires_at', 'last_used_at', 'refreshed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
