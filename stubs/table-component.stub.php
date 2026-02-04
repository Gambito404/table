<?php

namespace {{ namespace }};

use Gambito404\LivewireTables\Support\LivewireTable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class {{ class }} extends LivewireTable
{
    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
        ];
    }
}
