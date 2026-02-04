<?php

namespace ToolsTable\ToolsTable\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeTableCommand extends Command
{
    /**
     * La firma y el nombre del comando de consola.
     *
     * @var string
     */
    protected $signature = 'toolstable:make {name}';

    /**
     * La descripción del comando de consola.
     *
     * @var string
     */
    protected $description = 'Crea una nueva clase de tabla de Livewire para el paquete ToolsTable';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $path = $this->laravel['path'] . '/Livewire/Table/' . $name . '.php';

        if ($this->files->exists($path)) {
            $this->error("¡La tabla [{$name}] ya existe!");
            return 1;
        }

        $this->makeDirectory(dirname($path));

        $stub = $this->files->get(__DIR__.'/../../stubs/table.stub');
        $content = str_replace('{{ class }}', $name, $stub);

        $this->files->put($path, $content);

        $this->info("Tabla [app/Livewire/Table/{$name}.php] creada correctamente.");
        $this->comment("Ahora, impleméntala en una vista con: <livewire:table.{$name} />");
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0755, true, true);
        }
    }
}