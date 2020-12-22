<?php

namespace Models;

class Request
{
    public static function getHtml()
    {
        $url = "https://www.rightmove.co.uk/house-prices/search.html?searchLocation=Greater%20London";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $res = curl_exec($ch);
        $error = curl_error($ch);

        var_dump($error);
        curl_close($ch);
        return $res;
    }
}
