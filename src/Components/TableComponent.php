<?php

namespace YourVendor\ToolsTable\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

abstract class TableComponent extends Component
{
    use WithPagination;

    protected $paginationTheme;

    #[Url(history: true)]
    public string $search = '';

    #[Url]
    public string $sortField = 'id';

    #[Url]
    public string $sortDirection = 'desc';

    public function __construct()
    {
        $this->paginationTheme = config('tools-table.pagination_theme', 'tailwind');
    }

    abstract public function query();

    abstract public function columns(): array;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $query = $this->query();

        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return view('tools-table::datatable', [
            'rows' => $query->paginate(10),
            'columns' => $this->columns(),
        ]);
    }
}
