<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public static function all(): array
    {
        // load once with caching
        $dbSettings = cache()->rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $defaults = [
            'website_name'                      => 'Web Admin',
            'pagination_limit'                  => 25,

            'mail_mailer'                       => 'smtp',
            'mail_host'                         => null,
            'mail_port'                         => null,
            'mail_username'                     => null,
            'mail_password'                     => null,
            'mail_encryption'                   => null,
            'mail_from_address'                 => null,
            'mail_from_name'                    => null,
        ];

        // merge DB values over defaults
        return array_merge($defaults, $dbSettings);
    }
}
