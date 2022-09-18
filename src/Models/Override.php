<?php

namespace IsaEken\Envman\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use IsaEken\Envman\Facades\Envman;
use IsaEken\Envman\Memory;

class Override extends Model
{
    protected $table = 'envman_overrides';

    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    public function value(): Attribute
    {
        return new Attribute(
            get: fn ($value) => unserialize($value),
            set: fn ($value) => serialize($value),
        );
    }

    public static function current(): Builder
    {
        return Override::query()->where('group', '=', Envman::getGroup());
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function (Override $override) {
            if (config('envman.cache', false)) {
                /** @var Memory $memory */
                $memory = Envman::getMemory();
                $memory->flush()->generate()->save();
            }
        });
    }
}
