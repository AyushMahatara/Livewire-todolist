<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{

    #[Rule()]
    public $name;

    public function create()
    {
        dd('asd');
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
