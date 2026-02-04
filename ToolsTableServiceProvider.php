<?php

namespace YourVendor\ToolsTable;

use Illuminate\Support\ServiceProvider;

class ToolsTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Cargar vistas desde el directorio resources/views del paquete
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tools-table');

        // Publicar configuración
        $this->publishes([
            __DIR__ . '/../config/tools-table.php' => config_path('tools-table.php'),
        ], 'tools-table-config');

        // Publicar vistas (opcional, por si el usuario quiere modificarlas)
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tools-table'),
        ], 'tools-table-views');
    }

    public function register()
    {
        // Fusionar configuración por defecto
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tools-table.php', 'tools-table'
        );
    }
}