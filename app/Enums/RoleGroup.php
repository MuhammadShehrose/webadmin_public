<?php

namespace App\Enums;

enum RoleGroup: string
{
    case ADMIN = 'admin';
    case BRAND = 'brand';
    case USER  = 'user';

    /**
     * Return all enum values as an array.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return all enum values with labels (for dropdowns).
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [
            $case->value => ucfirst($case->value),
        ])->toArray();
    }
}
