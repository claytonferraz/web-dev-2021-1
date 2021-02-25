<?php

namespace App\Http\Livewire;
use App\Models\Item;

use Livewire\Component;

class Items extends Component
{


    public $message = 'Apenas um teste 2';

    public function render()
    {
        
        return view('items',compact('message'));
    }
}
