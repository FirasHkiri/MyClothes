<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'partner_id',
        'name', 
        'detail',
        'category_id',  
        'image'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
    
    public function category ()
    {
        return $this-> belongsTo(Category::class);
    }
}


