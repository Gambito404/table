<?php

namespace ToolsTable\ToolsTable\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolstable:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra un mensaje de prueba para verificar que el paquete está instalado.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('¡Hola! El paquete ToolsTable está instalado y su comando funciona correctamente.');
        $this->comment('Ahora puedes probar el componente de Livewire usando: <livewire:tools-table />');
    }
}