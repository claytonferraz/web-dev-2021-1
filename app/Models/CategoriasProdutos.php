<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CategoriasProdutos extends Model
{
    use HasFactory;
    use SoftDeletes;

    // base de dados existente...
     protected $table = 'categorias_produtos';

    protected $fillable= ['nome','descricao'];

    public function produtos()
    { 
        return $this->hasMany(Produtos::class, 'categoriasprodutos_id');
    }
}
