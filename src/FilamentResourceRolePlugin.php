<?php

namespace Firsadev\FilamentResourceRole;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Firsadev\FilamentResourceRole\Filament\Resources\Roles\RoleResource;

class FilamentResourceRolePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-resource-role';
    }

    public function register(Panel $panel): void
    {
      
        $panel->resources([
            RoleResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
