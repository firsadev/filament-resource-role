<?php

namespace Firsadev\FilamentResourceRole\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Firsadev\FilamentResourceRole\FilamentResourceRole
 */
class FilamentResourceRole extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Firsadev\FilamentResourceRole\FilamentResourceRole::class;
    }
}
