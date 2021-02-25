<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable= ['titulo','texto','categoria_id','user_id'];



    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoria()
    { 
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
}
