<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 14.09.2016
 * Time: 9:58
 */
class Log
{
    public static function Data($str_log){
        $data = time();
        $page = $_SERVER['REQUEST_URI'];
        $str = $str_log . "; " . $data . " -> " . $page . "\n";
        $file = fopen('Log.txt', 'a');
        fwrite($file, $str);
        fclose($file);
    }

    public static function info($message)
    {
        $str_log = "INFO: " . $message;
        self::Data($str_log);
    }

    public static function warning($message)
    {
        $str_log = "WARNING: " . $message;
        self::Data($str_log);
    }

    public static function error($message)
    {
        $str_log = "ERROR: " . $message;
        self::Data($str_log);
    }


}