<?php


if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
            return \App\Models\Setting::getValue($key, $default);
        });
    }
}

if (!function_exists('update_setting')) {
    function update_setting($key, $value)
    {
        $setting = \App\Models\Setting::setValue($key, $value);

        // clear cache for this key
        cache()->forget("setting_{$key}");

        return $setting;
    }
}
