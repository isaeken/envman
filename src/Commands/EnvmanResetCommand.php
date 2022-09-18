<?php

namespace IsaEken\Envman\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use IsaEken\Envman\Models\Override;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'envman:reset')]
class EnvmanResetCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'envman:reset
                {--force : Force the operation to run when in production}';

    protected static $defaultName = 'envman:reset';

    public $description = 'Reset all config';

    public function handle(): int
    {
        if ($this->confirmToProceed()) {
            if ($this->confirm('Are you sure to truncate all configurations?', false)) {
                Override::query()->truncate();
                $this->comment('All done');
            }

            return self::SUCCESS;
        }

        return self::FAILURE;
    }
}
