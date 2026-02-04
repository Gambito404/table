<?php

namespace ToolsTable\ToolsTable;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ToolsTable\ToolsTable\Components\ToolsTable;
use ToolsTable\ToolsTable\Commands\TestCommand;

class ToolsTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/tools-table.php' => config_path('tools-table.php'),
        ], 'tools-table-config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tools-table');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tools-table'),
        ], 'tools-table-views');

        Livewire::component('tools-table', ToolsTable::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tools-table.php', 'tools-table'
        );
    }
}
