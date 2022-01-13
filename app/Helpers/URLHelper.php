<?php

namespace App\Helpers;
use Config;

class URLHelper
{
    public static function adminLoggedInURL()
    {
        return url()->previous() == url('')."/" ? url('admin') : url()->previous();
    }
}
