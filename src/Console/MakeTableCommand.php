<?php

namespace Gambito404\LivewireTables\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeTableCommand extends Command
{
    protected $signature = 'make:livewire-table {name}';
    protected $description = 'Create a Livewire table component';

    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));
        $kebabName = Str::kebab($name);

        $componentPath = app_path("Livewire/Tables/{$name}.php");
        $viewPath = resource_path("views/livewire/tables/" . $kebabName . ".blade.php");

        File::ensureDirectoryExists(dirname($componentPath));
        File::ensureDirectoryExists(dirname($viewPath));

        File::put(
            $componentPath,
            $this->componentStub($name)
        );

        File::put(
            $viewPath,
            $this->viewStub()
        );

        $this->info("Livewire table component [{$name}] created successfully.");
        $this->comment("Usa tu componente así: <livewire:tables.{$kebabName} />");

        return self::SUCCESS;
    }

    protected function componentStub(string $name): string
    {
        $stub = File::get(__DIR__ . '/../../stubs/table-component.stub.php');
        return str_replace(
            ['{{ class }}', '{{ namespace }}', '{{ view_name }}'],
            [$name, 'App\\Livewire\\Tables', Str::kebab($name)],
            $stub
        );
    }

    protected function viewStub(): string
    {
        return File::get(__DIR__ . '/../../stubs/table-view.stub.blade.php');
    }
}
