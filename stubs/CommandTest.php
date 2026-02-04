<?php

namespace Gambito404\LivewireTables\Tests;

use Orchestra\Testbench\TestCase;
use Gambito404\LivewireTables\LivewireTableServiceProvider;

class CommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LivewireTableServiceProvider::class];
    }

    public function test_it_can_run_make_command()
    {
        $this->artisan('make:livewire-table', ['name' => 'UsersTable'])
             ->assertExitCode(0);
    }
}