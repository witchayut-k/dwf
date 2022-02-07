<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContentTemplateEnum extends Enum
{
    const RIGHT_COLUMN = 1;
    const LEFT_COLUMN =2;
    const FULLWIDTH = 3;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::RIGHT_COLUMN:
                return 'right_column';
                break;
            case self::LEFT_COLUMN:
                return 'left_column';
                break;
            case self::FULLWIDTH:
                return 'fullwidth';
                break;
            default:
                return self::getKey($value);
        }
    }
}
