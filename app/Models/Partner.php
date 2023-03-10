<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Partner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $table = 'partners';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
