<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // load all settings once
        $settings = SettingService::all();

        config([
            // override mail configs
            'mail.mailers.smtp.host'        => $settings['mail_host']           ?? env('MAIL_HOST'),
            'mail.mailers.smtp.port'        => $settings['mail_port']           ?? env('MAIL_PORT'),
            'mail.mailers.smtp.encryption'  => $settings['mail_encryption']     ?? env('MAIL_ENCRYPTION'),
            'mail.mailers.smtp.username'    => $settings['mail_username']       ?? env('MAIL_USERNAME'),
            'mail.mailers.smtp.password'    => $settings['mail_password']       ?? env('MAIL_PASSWORD'),
            'mail.from.address'             => $settings['mail_from_address']   ?? env('MAIL_FROM_ADDRESS'),
            'mail.from.name'                => $settings['mail_from_name']      ?? env('MAIL_FROM_NAME'),
            'mail.default'                  => $settings['mail_mailer']         ?? env('MAIL_MAILER'),

            // override any other required config
        ]);
    }
}
