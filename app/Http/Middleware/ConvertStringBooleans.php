<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertStringBooleans extends TransformsRequest
{
    protected function transform($key, $value)
    {
        $inputs = ['published', 'enabled', 'active', 'pinned', 'is_page', 'is_popup', 'delete_image'];

        if (in_array($key, $inputs)) {
            if (strtolower($value) === 'true' || $value === 'on' || $value === '1')
                return true;

            if (strtolower($value) === 'false' || $value === '' || $value === '0')
                return false;
        }

        return $value;
    }
}
