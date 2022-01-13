<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRoleEnum extends Enum
{
    const USER = 1;
    const ADMIN = 9;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::USER:
                return 'User';
                break;
            case self::ADMIN:
                return 'Administrator';
                break;
            default:
                return self::getKey($value);
        }
    }

    public static function getRoleKey($value): string
    {
        switch ($value) {
            case 'User':
                return self::USER;
                break;
            case 'Administrator':
                return self::ADMIN;
                break;
            default:
                return self::getKey($value);
        }
    }
}
