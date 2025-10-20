<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    public static function boot()
    {
        parent::boot();

        static::saved(function () {
            cache()->forget('settings'); // clear all settings cache
        });

        static::deleted(function () {
            cache()->forget('settings');
        });
    }

    public static function getValue($key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

}
