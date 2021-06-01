<?php

class Prayer
{
    //private static $_key = 'e39c95b42e1222d29f4e9ee28a1fbcde';

    /**
     * @return Curl
     */
    public static function get()
    {
        $curl = new Curl();
//        $curl->get("http://muslimsalat.com/najaf/daily.json?key=" . self::$_key,false);
        $curl->get("https://api.pray.zone/v2/times/today.json?city=najaf",false);
        return $curl;
    }
}