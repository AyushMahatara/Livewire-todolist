<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public $editingName;
    public $editingID;
    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        session()->flash('success', 'Created.');
    }


    public function edit($todoID)
    {

        $this->editingID = $todoID;
        $this->editingName = Todo::find($todoID)->name;
    }

    public function update()
    {
        Todo::find($todoID)->delete();
    }

    public function cancel()
    {
        $this->reset();
    }

    public function delete($todoID)
    {
        Todo::find($todoID)->delete();
    }

    public function toggleCheck($todoID)
    {
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function render()
    {

        return view(
            'livewire.todo-list',
            ['todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)]
        );
    }
}
