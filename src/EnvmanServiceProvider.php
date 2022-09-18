<?php

namespace IsaEken\Envman;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use IsaEken\Envman\Commands\EnvmanCacheClearCommand;
use IsaEken\Envman\Commands\EnvmanCacheCommand;
use IsaEken\Envman\Commands\EnvmanResetCommand;
use IsaEken\Envman\Facades\Envman;
use IsaEken\Envman\Models\Override;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EnvmanServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('envman')
            ->hasConfigFile()
            ->hasMigration('create_envman_overrides_table')
            ->hasCommand(EnvmanResetCommand::class)
            ->hasCommand(EnvmanCacheCommand::class)
            ->hasCommand(EnvmanCacheClearCommand::class)
        ;
    }

    public function packageBooted()
    {
        if (config('envman.enabled', false) && ! $this->app->runningInConsole()) {
            foreach ($this->getOverrides() as $override) {
                config()->set($override['key'], $override['value'] ?? config($override['key']));
            }
        }
    }

    protected function getOverrides(): array
    {
        return array_filter(
            Envman::getMemory()->get('overrides'),
            fn ($override) => $override['group'] == Envman::getGroup()
        );
    }
}
