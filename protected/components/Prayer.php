<?php

class Prayer
{
    private static $_key = '53281d302cfab8d904fa66d263f88ae2';

    /**
     * @return Curl
     */
    public static function get()
    {
        $curl = new Curl();
        $curl->get("http://muslimsalat.com/najaf/daily.json?key=" . self::$_key,false);
        return $curl;
    }
}