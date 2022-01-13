<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContentTypeEnum extends Enum
{
    const ABOUT = 1;
    const ANNOUNCE =2;
    const NEWS = 3;
    const SERVICE = 4;
    const KM = 5;
    const STATISTIC = 6;
    const PLAN = 7;
    const ACTIVITY = 8;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::ABOUT:
                return 'เกี่ยวกับ ส.ค.';
                break;
            case self::ANNOUNCE:
                return 'ประชาสัมพันธ์';
                break;
            case self::NEWS:
                return 'ข่าวประชาสัมพันธ์';
                break;
            case self::SERVICE:
                return 'บริการ';
                break;
            case self::KM:
                return 'คลังความรู้';
                break;
            case self::STATISTIC:
                return 'ข้อมูลสถิติ';
                break;
            case self::PLAN:
                return 'แผน-ผล';
                break;
            case self::ACTIVITY:
                return 'กิจกรรม ส.ค.';
                break;
            default:
                return self::getKey($value);
        }
    }
}
