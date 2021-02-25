<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produtos as ModelProdutos;
use App\Models\CategoriasProdutos;

class Produtos extends Component
{
    // aqui os atributos do produto
    public $nome, $descricao, $preco, $produto_id, $categoriaproduto_id; 
    
    // controle do modal
    public $isOpen = false;
    
    public function render()
    {
         $produtos = ModelProdutos::latest()->paginate(4);
         $categoriasprodutos = CategoriasProdutos::all();
        
        return view('livewire.produtos.produtos', compact('produtos', 'categoriasprodutos'));
    }


/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->nome = '';
        $this->descricao = '';
        $this->preco = '';
        $this->categoriaproduto_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'categoriaproduto_id' => 'required',
        ]);

        ModelProdutos::updateOrCreate(['id' => $this->produto_id], [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'categoriaproduto_id' => $this->categoriaproduto_id,
            //recuperar o id do usuario logado
            // 'user_id' => auth()->user()->id,
        ]);

        session()->flash('message',
            $this->produto_id ? 'Produto Atualizado com Sucesso.' : 'Produto Criado com Sucesso.');

        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $produto = ModelProdutos::findOrFail($id);
        $categoria = CategoriasProdutos::all();
        $this->produto_id = $id;
        $this->nome = $produto->nome;
        $this->descricao = $produto->descricao;
        $this->preco = $produto->preco;
        $this->categoriaproduto_id = $produto->categoria_id;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        ModelProdutos::find($id)->delete();
        session()->flash('message', 'Produto Deletado com Sucesso.');
    }
}
