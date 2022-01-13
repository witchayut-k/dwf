<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MenuTypeEnum extends Enum
{
    const BLANK = 1;
    const CONTENT = 2;
    const CONTENT_CATEGORY = 3;
    const WEBLINK = 4;
    const INTERNALLINK = 5;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::BLANK:
                return 'เมนูหลัก';
                break;
            case self::CONTENT:
                return 'เนื้อหาเว็บไซต์';
                break;
            case self::CONTENT_CATEGORY:
                return 'หมวดหมู่เนื้อหา';
                break;
            case self::WEBLINK:
                return 'เว็บลิงค์';
                break;
            case self::INTERNALLINK:
                return 'ลิงค์ภายใน';
                break;
            default:
                return self::getKey($value);
        }
    }
}
