<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 14.09.2016
 * Time: 11:39
 */
class Autoloader // our personal autoloader
{
    private static $_lastLoadedFile;
    public static function load($class){
        self::$_lastLoadedFile = $class.".php";
        require_once(self::$_lastLoadedFile);
    }

    public static function loadAndLog($class){
        self::load($class);
        Log::info("Класс " . $class . " из файла " . self::$_lastLoadedFile);
    }
}