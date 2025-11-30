<?php

namespace Firsadev\FilamentResourceRole\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('users')
                    ->relationship('users','name')
                    ->preload()
                    ->multiple()
            ]);
    }
}
