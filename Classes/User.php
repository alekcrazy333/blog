<?php

require_once("Classes/DataBase.php");
require_once("Classes/Entity.php");
require_once("Classes/Log.php");


class User extends Entity
{
    private $login;
    private $name;
    private $pass;
    private $db;


    function __construct($login, $name, $pass)
    {
        $this->login = $login;
        $this->name = $name;
        $this->pass = $pass;
        $this->db = new DataBase("127.0.0.1", "root", "", "mydb");
        $this->db->connect();

    }

    public static function getId(){
        echo 'getId';
    }

    function addUser()
    {
        $query = "INSERT INTO User (login, name, pass_hash, pass_reset) VALUES ('$this->login', '$this->name', '$this->pass', '$this->pass')";
        $this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("User " . $this->name . "sucsessfully added");
        echo 'Успешно добавлено';
    }

    public function delete_user($name)
    {
        $query = "DELETE FROM `User` WHERE User.login = '$name'";
        $this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("User " . $this->name . "sucsessfully deleted");
        echo 'Успешно удалено';
    }

    public function __toString(){
        Log::warning("Вывод oбьекта класса User");
        return $this->name . "";
    }
    public function __get($name)
    {
        Log::error("Вызов несуществующего свойства " . $name . " в классе " . __CLASS__);
        echo "Такого свойства " . $name . " нет" ;
    }
    public function __set($name, $value )
    {
        Log::error("Определение несуществующего свойства " . $name . " в классе " . __CLASS__);
        echo "Вы не можете определить не сущесвтующее свойство " . $name;
    }

    public function __call($name, $arguments)
    {
        Log::error("Вызов несуществующего метода " . $name . " в классе " . __CLASS__);
    }

    static public function select_user()
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if (mysqli_connect_errno()) {
            echo 'mysqli_connect_error()';
            exit();
        }
        $query2 = mysqli_query($connect, "SELECT * FROM User");
        $result = mysqli_fetch_all($query2);

        foreach ($result as $r) {
            ?>
            <option><? echo $r['1'] ?></option>
            <?php
        }
        mysqli_close($connect);
    }
    static public function select_userId($name){
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $id = mysqli_query($connect,"SELECT * FROM User WHERE User.login = '$name'");
        $result = mysqli_fetch_all($id);
        mysqli_close($connect);
        foreach($result as $r) {
            return $r['0'];
        }
    }


}