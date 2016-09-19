<?php

require_once("Classes/DataBase.php");
require_once("Classes/Log.php");


class Category{

	private $db;

	function __construct(){
		$this->db = new DataBase("127.0.0.1", "root", "", "mydb");
        $this->db->connect();
	}

	public function add_category($name)
    {
       	$query = "INSERT INTO Categories(name) VALUES ('$name')";
       	$this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("Category " . $name . "sucsessfully added");
        //echo 'Успешно добавлено';
    }

    public function delete_category($name)
    {
       	$query = "DELETE FROM `Categories` WHERE Categories.name = '$name'";
       	$this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("Category " . $name . "sucsessfully deleted");
        //echo 'Успешно удалено';
    }

    static public function select_category()
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $query2 = mysqli_query($connect,"SELECT * FROM Categories");
        $result = mysqli_fetch_all($query2);

        foreach($result as $r) {
            ?>
            <option><?echo $r['1']?></option>
            <?php
        }
        mysqli_close($connect);
    }
    static public function select_categoryId($name){
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $id = mysqli_query($connect,"SELECT * FROM Categories WHERE Categories.name = '$name'");
        $result = mysqli_fetch_all($id);
        mysqli_close($connect);
        foreach($result as $r) {
            return $r['0'];
        }
    }


}
