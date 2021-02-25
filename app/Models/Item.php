<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable= ['nome','preco','status'];

    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
}
