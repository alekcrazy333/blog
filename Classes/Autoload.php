<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 14.09.2016
 * Time: 11:19
 */
function __autoload($class){
    require_once("Classes/$class.php");
}