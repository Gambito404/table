<?php

namespace ToolsTable\ToolsTable\Components;

use Livewire\Component;
use Livewire\WithPagination;

abstract class ToolsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Resetea la paginación cuando se busca algo
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Métodos abstractos que el usuario debe implementar
    abstract public function query();
    abstract public function columns(): array;

    public function render()
    {
        $query = $this->query();

        if ($this->search) {
            // Lógica de búsqueda simple. Se puede mejorar.
            $query->where(function ($q) {
                foreach ($this->columns() as $column) {
                    $q->orWhere($column['key'], 'like', '%' . $this->search . '%');
                }
            });
        }

        return view('tools-table::datatable', [
            'rows' => $query->paginate($this->perPage),
            'columns' => $this->columns(),
        ]);
    }
}