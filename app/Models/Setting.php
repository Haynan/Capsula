<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function getMany(array $keys): array
    {
        return static::query()
            ->whereIn('key', $keys)
            ->pluck('value', 'key')
            ->all();
    }
}
