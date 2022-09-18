<?php

namespace IsaEken\Envman\Facades;

use Illuminate\Support\Facades\Facade;
use IsaEken\Envman\Memory;

/**
 * @see \IsaEken\Envman\Envman
 *
 * @method Memory getMemory()
 * @method string|null getGroup()
 * @method self setConfig(string $key, mixed $value)
 * @method self resetConfig(string $key)
 */
class Envman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \IsaEken\Envman\Envman::class;
    }
}
