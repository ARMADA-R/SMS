<?php

use App\Models\Language;
use App\Models\Settings;

if (!function_exists('AdminUrl')) {
    function AdminUrl($url = null)
    {
        return url('manager/' . $url);
    }
}



if (!function_exists('settings')) {

    function settings($attr = null)
    {
        if ($attr) {
            return isset(Settings::getsettings()[$attr]) ? Settings::getsettings()[$attr] : null;
        }
        return (Settings::getsettings());
    }
}
