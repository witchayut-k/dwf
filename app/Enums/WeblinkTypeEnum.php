<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WeblinkTypeEnum extends Enum
{
    const SERVICE = 1;
    const SOCIAL_NETWORK_TOP = 2;
    const DEPARTMENT = 3;
    const RELATED_LINK = 4;
    const GOV_LINK = 5;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::SERVICE:
                return 'Link บริการ สค';
                break;
            case self::SOCIAL_NETWORK_TOP:
                return 'Social Network (บน)';
                break;
            case self::DEPARTMENT:
                return 'หน่วยงานส่วนภูมิภาค';
                break;
            case self::RELATED_LINK:
                return 'Link ที่เกี่ยวข้อง';
                break;
            case self::GOV_LINK:
                return 'สำหรับข้าราชการ';
                break;
            default:
                return self::getKey($value);
        }
    }
}
