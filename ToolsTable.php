<?php

namespace ToolsTable\ToolsTable\Components;

use Livewire\Component;

class ToolsTable extends Component
{
    public $message = '¡Hola! El paquete de prueba funciona.';

    public function render()
    {
        // Para la prueba inicial, renderizamos una vista simple.
        // El componente se puede invocar en cualquier vista de Blade con:
        // <livewire:tools-table />
        return view('tools-table::datatable');
    }
}