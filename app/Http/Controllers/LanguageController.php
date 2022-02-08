<?php

namespace App\Http\Controllers;

use Config;
use Session;
use Redirect;

use Illuminate\Http\Request;

use App\IServices\Backoffice\IUserService;

class LanguageController extends Controller
{

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }

        return Redirect::back();
    }
}
