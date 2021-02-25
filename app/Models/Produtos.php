<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Produtos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable= ['nome','descricao','preco','categoriaproduto_id'];

    public function categoria()
    {
        return $this->belongsTo(CategoriasProdutos::class, 'categoriaproduto_id', 'id');
    }

    

}
