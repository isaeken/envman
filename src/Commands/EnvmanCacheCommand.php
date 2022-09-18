<?php

namespace IsaEken\Envman\Commands;

use Illuminate\Console\Command;
use IsaEken\Envman\Facades\Envman;
use IsaEken\Envman\Memory;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'envman:cache')]
class EnvmanCacheCommand extends Command
{
    protected $signature = 'envman:cache';

    protected static $defaultName = 'envman:cache';

    public $description = 'Cache all config';

    public function handle(): int
    {
        /** @var Memory $memory */
        $memory = Envman::getMemory();
        $memory->generate()->save();
        $this->comment('Cache generated successfully.');

        return self::SUCCESS;
    }
}
