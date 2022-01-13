<?php
namespace App\Helpers;

class FormHelper
{
    public static function getCheckboxValue($value) {
        $result = TRUE;
        if (empty($value))
            $result = FALSE;
        else if ($value != "on" && $value != 1 && !$value)
            $result = FALSE;
        else if ($value == "false")
            $result = FALSE;

        return $result;
    }

    public static function NumberToString($value) {
        $result = str_replace(",", "", $value);
        return $result;
    }
}
