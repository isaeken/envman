<?php

namespace IsaEken\Envman;

use IsaEken\Envman\Models\Override;

class Envman
{
    private Memory|null $memory = null;

    public function getMemory(): Memory
    {
        if (is_null($this->memory)) {
            $this->memory = new Memory();
        }

        return $this->memory;
    }

    public function getGroup(): string|null
    {
        return config('envman.features.domains', false) ? request()->getHost() : null;
    }

    public function setConfig(string $key, mixed $value): self
    {
        $override = Override::current()->where('key', $key)->first();

        if (is_null($override)) {
            Override::query()->create([
                'group' => $this->getGroup(),
                'key' => $key,
                'value' => $value,
            ]);
        } else {
            $override->update([
                'value' => $value,
            ]);
        }

        config()->set($key, $value);

        return $this;
    }

    public function resetConfig(string $key): self
    {
        Override::current()->where('key', $key)->delete();
        return $this;
    }
}
