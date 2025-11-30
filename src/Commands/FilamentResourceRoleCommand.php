<?php

namespace Firsadev\FilamentResourceRole\Commands;

use Illuminate\Console\Command;

class FilamentResourceRoleCommand extends Command
{
    public $signature = 'filament-resource-role';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
