<?php

namespace Gambito404\LivewireTables\Support;

use Livewire\Component;
use Livewire\WithPagination;

abstract class LivewireTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    abstract public function query();
    abstract public function columns(): array;

    public function render()
    {
        // Nota: En una implementación real, aquí renderizarías la vista base
        // o dejarías que el stub defina su propia vista.
        // Por ahora, para el testeo, retornamos una vista genérica si existe.
        return view('livewire-tables::datatable', [
            'rows' => $this->query()->paginate($this->perPage),
            'columns' => $this->columns(),
        ]);
    }
}