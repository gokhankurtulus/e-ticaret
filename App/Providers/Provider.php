<?php

namespace App\Providers;

use App\Models\{Settings, Category};
use App\Providers\Route as Route;

class Provider
{
    const BASEURL = "http://localhost/e-ticaret/";
    const PANELURL = "http://localhost/e-ticaret/panel/";
    const APP_URL = self::BASEURL . "App/";
    const PUBLIC_URL = self::BASEURL . "public/";
    const VIEW_URL = "public/views/";


    public static function boot()
    {
        date_default_timezone_set('Europe/Istanbul');
        setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');

        spl_autoload_register(function ($class) {
            if (is_file($class . '.php')) {
                require_once($class . '.php');
            }
        });
        $GLOBALS['default_language'] = 'en';
        $GLOBALS['allowed_languages'] = ['tr', 'en', 'ru'];

        $GLOBALS['route'] = new Route;
        $GLOBALS['route']->get();
        if (!in_array($GLOBALS['route']->getLanguage(), $GLOBALS['allowed_languages'])) {
            $countryCode = strtolower(ip_info(purpose: "Country Code"));
            if (in_array($countryCode, $GLOBALS['allowed_languages'])) {
                header("Location: " . self::BASEURL . $countryCode);
                exit();
            } else {
                header("Location: " . self::BASEURL . $GLOBALS['default_language']);
                exit();
            }
        }

        if (!isset($GLOBALS['settings']))
            $GLOBALS['settings'] = Settings::get(where: ['id' => 1]);
        if (!isset($GLOBALS['categories']))
            $GLOBALS['categories'] = Category::tree(['status' => 1]);

    }
}

function view($path)
{
    if (is_file(Provider::VIEW_URL . "$path"))
        include Provider::VIEW_URL . "$path";
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city" => @$ipdat->geoplugin_city,
                        "state" => @$ipdat->geoplugin_regionName,
                        "country" => @$ipdat->geoplugin_countryName,
                        "country_code" => @$ipdat->geoplugin_countryCode,
                        "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}