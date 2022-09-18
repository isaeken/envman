<?php

namespace IsaEken\Envman;

use Illuminate\Database\Eloquent\Collection;
use IsaEken\Envman\Models\Override;

class Memory
{
    protected static array $memory = [];

    public static array $queries = [];

    public function __construct()
    {
        if (file_exists($this->filePath())) {
            static::$memory = include_once $this->filePath();
        }

        static::$queries = [
            'overrides' => function (): array {
                return Override::query()->get(['group', 'key', 'value'])->toArray();
            },
        ];
    }

    public function get(string $key): mixed
    {
        if (isset(static::$memory[$key])) {
            return static::$memory[$key];
        }

        return static::$memory[$key] = static::$queries[$key]();
    }

    public function generate(): self
    {
        foreach (array_keys($this::$queries) as $query) {
            $this->get($query);
        }

        return $this;
    }

    public function flush(): self
    {
        static::$memory = [];
        @unlink($this->filePath());

        return $this;
    }

    public function save(): self
    {
        file_put_contents($this->filePath(), "<?php return " . var_export(static::$memory, true) . ";");

        return $this;
    }

    public function filePath(): string
    {
        return app('path.bootstrap').'/cache/envman.php';
    }
}
