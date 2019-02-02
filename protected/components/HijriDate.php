<?php

class HijriDate
{
    /**
     * @return Curl
     * @param $date string
     */
    public static function get($date = null)
    {
        if(is_null($date))
            $date = date('d-m-Y');

        $curl = new Curl();
        $curl->get("http://api.aladhan.com/v1/gToH?date=" . $date,false);
        return $curl;
    }
}