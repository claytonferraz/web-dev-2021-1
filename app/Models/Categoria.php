<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable= ['nome','descricao'];

    public function blog()
    { 
        return $this->hasMany(Categoria::class, 'categoria_id', 'id');
    }
}
