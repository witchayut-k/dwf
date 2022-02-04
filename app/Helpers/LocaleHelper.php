<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class LocaleHelper
{
    public static function getTranslated($datas) 
    {
        $lang = Session::get('applocale');
        if (is_null($lang)) 
            $lang = 'th';

        foreach ($datas as $key => $value) {
            if (strpos($key,  $lang) !== false) {
                if (!empty($value)) {
                    return $value;
                }
            }
        }

        //Get en data if no record macth to user default lang
        foreach ($datas as $key => $value) {
            if (strpos($key,  'th') !== false) {
                if (!empty($value)) {
                    return $value;
                }
            }
        }
        return null;
    }
}
