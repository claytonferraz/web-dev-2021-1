<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $nome, $descricao, $categoria_id;
    public $isOpen = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {

        $categorias = Categoria::latest()->paginate(4);

        return view('livewire.categoria.categorias', compact('categorias'));

        
        

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
        $this->categoria_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        // aqui fazemos as validações dos dados
        $this->validate([
            'nome' => 'required|unique:categorias',
            'descricao' => 'required',
        ]);
        // aqui o metodo cria um novo ou altera se existir
        Categoria::updateOrCreate(['id' => $this->categoria_id], [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
        ]);
            // mensagem dizendo que foi editado ou criado um novo registro
        session()->flash('message',
            $this->categoria_id ? 'Categoria Atulizada com Sucesso.' : 'Categoria Criada com Sucesso.');

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
        $categoria = Categoria::findOrFail($id);
        $this->categoria_id = $id;
        $this->nome = $categoria->nome;
        $this->descricao = $categoria->descricao;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Categoria::find($id)->delete();
        session()->flash('message', 'Categoria Deletada com Sucesso.');
    }
}
