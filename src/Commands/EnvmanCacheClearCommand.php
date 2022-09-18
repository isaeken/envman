<?php

namespace IsaEken\Envman\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use IsaEken\Envman\Facades\Envman;
use IsaEken\Envman\Memory;
use IsaEken\Envman\Models\Override;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'envman:cache:clear')]
class EnvmanCacheClearCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'envman:cache:clear
                {--force : Force the operation to run when in production}';

    protected static $defaultName = 'envman:cache:clear';

    public $description = 'Clear Envman cache';

    public function handle(): int
    {
        if ($this->confirmToProceed()) {
            /** @var Memory $memory */
            $memory = Envman::getMemory();
            $memory->flush();
            $this->comment('Cache cleared successfully.');

            return self::SUCCESS;
        }

        return self::FAILURE;
    }
}
