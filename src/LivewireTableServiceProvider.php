<?php

namespace Gambito404\LivewireTables;

use Illuminate\Support\ServiceProvider;
use Gambito404\LivewireTables\Console\MakeTableCommand;

class LivewireTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeTableCommand::class,
            ]);
        }
        
        $this->publishes([
            __DIR__.'/../stubs' => base_path('stubs/vendor/livewire-tables'),
        ], 'livewire-tables-stubs');
    }
}
