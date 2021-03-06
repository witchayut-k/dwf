<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PermissionEnum extends Enum
{
    const MANAGE_LANDING_PAGE = 1;
    const MANAGE_CONTENT = 2;
    const MANAGE_MENU = 3;
    // const MANAGE_BUDGET = 3;
    const MANAGE_WEBLINK = 4;
    const MANAGE_BACKEND_USER = 5;
    const MANAGE_RSS_FEED = 6;
    const MANAGE_FAQ = 7;
    const MANAGE_DOWNLOAD = 8;
    const MANAGE_BANNER = 9;
    const MANAGE_CONTACT = 10;
    const MANAGE_ALBUM = 11;
    const MANAGE_VIDEO = 12;
    const MANAGE_EVENT = 13;
    // const MANAGE_SITEMAP = 14;
    const MANAGE_SURVEY = 15;
    const MANAGE_REGISTRAR = 16;
    const MANAGE_PETITION = 17;
    // const MANAGE_MAP = 18;

    /**
     * Get the description for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::MANAGE_LANDING_PAGE:
                return 'manage landing page';
                break;
            case self::MANAGE_CONTENT:
                return 'manage content';
                break;
            case self::MANAGE_MENU:
                return 'manage menu';
                break;
                // case self::MANAGE_BUDGET:
                //     return 'manage budget';
                //     break;
            case self::MANAGE_WEBLINK:
                return 'manage weblink';
                break;
            case self::MANAGE_BACKEND_USER:
                return 'manage backend user';
                break;
            case self::MANAGE_RSS_FEED:
                return 'manage rss feed';
                break;
            case self::MANAGE_FAQ:
                return 'manage faq';
                break;
            case self::MANAGE_DOWNLOAD:
                return 'manage download';
                break;
            case self::MANAGE_BANNER:
                return 'manage banner';
                break;
            case self::MANAGE_CONTACT:
                return 'manage contact';
                break;
            case self::MANAGE_ALBUM:
                return 'manage album';
                break;
            case self::MANAGE_VIDEO:
                return 'manage video';
                break;
            case self::MANAGE_EVENT:
                return 'manage event';
                break;
                // case self::MANAGE_SITEMAP:
                //     return 'manage sitemap';
                //     break;
            case self::MANAGE_SURVEY:
                return 'manage survey';
                break;
            case self::MANAGE_REGISTRAR:
                return 'manage registrar';
                break;
            case self::MANAGE_PETITION:
                return 'manage petition';
                break;
                // case self::MANAGE_MAP:
                //     return 'manage map';
                //     break;
            default:
                return self::getKey($value);
        }
    }

    /**
     * Get the name for an enum value
     *
     * @param  string  $value
     * @return string
     */
    public static function getName($value): string
    {
        switch ($value) {
            case self::MANAGE_LANDING_PAGE:
                return '?????????????????? Landing Page';
                break;
            case self::MANAGE_CONTENT:
                return '???????????????????????????????????????????????????????????????';
                break;
            case self::MANAGE_MENU:
                return '??????????????????????????????????????????????????????';
                break;
                // case self::MANAGE_BUDGET:
                //     return '???????????????????????????????????????????????????????????????';
                //     break;
            case self::MANAGE_WEBLINK:
                return '?????????????????????????????????????????????';
                break;
            case self::MANAGE_BACKEND_USER:
                return '?????????????????? Backend User';
                break;
            case self::MANAGE_RSS_FEED:
                return '?????????????????? RSS Feed';
                break;
            case self::MANAGE_FAQ:
                return '?????????????????? FAQ';
                break;
            case self::MANAGE_DOWNLOAD:
                return '???????????????????????????????????? Download';
                break;
            case self::MANAGE_BANNER:
                return '??????????????????????????????????????????';
                break;
            case self::MANAGE_CONTACT:
                return '??????????????????????????????????????????????????????????????????';
                break;
            case self::MANAGE_ALBUM:
                return '???????????????????????????????????????';
                break;
            case self::MANAGE_VIDEO:
                return '????????????????????????????????????????????????';
                break;
            case self::MANAGE_EVENT:
                return '????????????????????????????????????????????????????????????';
                break;
                // case self::MANAGE_SITEMAP:
                //     return '????????????????????????????????????????????????????????????';
                //     break;
            case self::MANAGE_SURVEY:
                return '??????????????????????????????????????????';
                break;
            case self::MANAGE_REGISTRAR:
                return '?????????????????????????????????????????????????????????';
                break;
            case self::MANAGE_PETITION:
                return '???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????';
                break;
            default:
                return self::getKey($value);
        }
    }
}
