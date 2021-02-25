<?php

namespace App\Http\Livewire;

use App\Models\CategoriasProdutos as ModelCatProduto;
use Livewire\Component;

class CategoriasProdutos extends Component
{

    public $nome, $descricao, $categoriasprodutos_id;
    public $isOpen = 0;

    public function render()
    {
        $categoriasprodutos = ModelCatProduto::latest()->paginate(3);

        return view('livewire.categoriasprodutos.categorias-produtos', compact('categoriasprodutos'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->nome = '';
        $this->descricao = '';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();

    }
    public function edit($id)
    {
        $categoriasprodutos = ModelCatProduto::findOrFail($id);
        $this->categoriasprodutos_id = $id;
        $this->nome = $categoriasprodutos->nome;
        $this->descricao = $categoriasprodutos->descricao;

        $this->openModal();


    }
    public function store()
    {

        // aqui fazemos as validações dos dados
        $this->validate([
            'nome' => 'required',
            'descricao' => 'required|max:255',
        ]);
        // aqui o metodo cria um novo ou altera se existir
        ModelCatProduto::updateOrCreate(['id' => $this->categoriasprodutos_id], [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
        ]);

        // mensagem dizendo que foi editado ou criado um novo registro
        session()->flash('message',
            $this->categoriasprodutos_id ? 'Categoria Atualizada com Sucesso.' : 'Categoria Criada com Sucesso.');

        $this->closeModal();
        $this->resetInputFields();

    }
    public function delete($id)
    {
            ModelCatProduto::find($id)->delete();
            session()->flash('message', 'Categoria Deletada com Sucesso.');

    }

}
