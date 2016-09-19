<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 12.09.2016
 * Time: 9:42
 */
class DataBase
{
    private $host;
    private $login;
    private $password;
    private $dbName;
    private $connect;

    function __construct($host, $login, $password, $dbName)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function connect()
    {
        $this->connect = new mysqli($this->host, $this->login, $this->password, $this->dbName);
        if($this->connect->connect_errno)
        {
            echo 'mysqli_connect_error()';
            exit();
        }
    }

    public function disconnect()
     {
        $this->connect->close();
    }

    public function optionalQuery($str)
    {
        $this->connect->query($str);
       // mysqli_query($this->connect, $str);
        echo "Успешно выполено";
    }

    public function selectAll($str)
    {
        //$this->connect->query($str);
        //$query = mysqli_query($this->connect, $str);
        //$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        //$query = $this->connect->query($str);
        //$result = $query->fetch_all();
        return $this->connect->query($str)->fetch_all();
    }

}