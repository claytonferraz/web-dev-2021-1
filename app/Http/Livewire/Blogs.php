<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    public $titulo, $texto, $blog_id, $categoria_id;
    public $isOpen = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {

        $blogs = Blog::latest()->paginate(4);
        $categorias = Categoria::All();

        return view('livewire.blog.blogs', compact('blogs','categorias'));

        
        

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
        $this->titulo = '';
        $this->texto = '';
        $this->categoria_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'texto' => 'required',
            'categoria_id' => 'required',
        ]);

        Blog::updateOrCreate(['id' => $this->blog_id], [
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'categoria_id' => $this->categoria_id,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('message',
            $this->blog_id ? 'Categoria Atulizada com Sucesso.' : 'Categoria Criada com Sucesso.');

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
        $blog = Blog::findOrFail($id);
        $categoria = Categoria::all();
        $this->blog_id = $id;
        $this->titulo = $blog->titulo;
        $this->texto = $blog->texto;
        $this->categoria_id = $blog->categoria_id;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Categoria Deletada com Sucesso.');
    }
}