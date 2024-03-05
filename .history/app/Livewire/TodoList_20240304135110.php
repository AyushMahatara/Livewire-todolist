<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{

    #[Rule('required|min:3|max:50')]
    public $name;

    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        session()->flash('success', 'Created.');
    }

    public function render()
    {

        return view(
            'livewire.todo-list',
            ['todos' => Todo::latest()->get()]
        );
    }
}
