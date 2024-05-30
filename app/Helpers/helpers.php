<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


const SUPAR_ADMIN = 1;
const ADMIN = 2;
const STUDENT = 3;


if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 2);
    }
}

// if (!function_exists('get_setting')) {
//     function get_setting($key, $default = null, $lang = false)
//     {
//         $settings = Cache::remember('business_settings', 86400, function () {
//             return BusinessSetting::all();
//         });

//         if ($lang == false) {
//             $setting = $settings->where('type', $key)->first();
//         } else {
//             $setting = $settings->where('type', $key)->where('lang', $lang)->first();
//             $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
//         }
//         return $setting == null ? $default : $setting->value;
//     }
// }


// if (!function_exists('uploaded_asset')) {
//     function uploaded_asset($id)
//     {
//         $file = Upload::find($id);

//         if ($file && File::exists($file->external_link)) {
//             return app('url')->asset($file->external_link);
//         }

//         return static_asset('demo/img/placeholder.svg');
//     }
// }


function filterAirportCode($name)
{
    $parts = explode('-', $name);
    $origincity = isset($parts[1]) ? trim($parts[1], " \t\n\r\0\x0B") : '';
    return str_replace(['(', ')'], '', $origincity);
}
function changeDateYmdFormet($date)
{
    $carbonDate = Carbon::createFromFormat('D, d M', $date);
    return $carbonDate->format('Ymd');
}

function convertToHoursAndMinutes($minutes)
{
    $minutes = intval($minutes);
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;

    if ($hours > 0) {
        return "$hours hr $remainingMinutes min";
    } else {
        return "$remainingMinutes min";
    }
}


function findFlag($flightNumber)
{
    $flight = preg_replace('/\d+/', '', $flightNumber);
    $flightWithSpace = preg_replace('/([A-Z]{2})/', '$1 ', $flight);
    $flightWithoutSpace = preg_replace('/\s+/', '', $flightWithSpace);
    return 'http://airiq.mywebcheck.in/v3/Images/AirwaysLogo/' . $flightWithoutSpace . '.png';
}
