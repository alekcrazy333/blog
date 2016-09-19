<?php

require_once("Classes/DataBase.php");
require_once("Classes/Log.php");

class Blog{
	
	private $db;

	function __construct(){
		$this->db = new DataBase("127.0.0.1", "root", "", "mydb");
        $this->db->connect();
	}

	public function select_blog()
    {
        $query = "SELECT * FROM Blog";
        $result = $this->db->selectAll($query);
        foreach($result as $r) {
            ?><option><?echo $r['1']?></option><?php
        }
        $this->db->disconnect();
    }

    public function add_blog($title, $content, $user_id, $created_at, $updated_at, $category_id, $src)
    {
		$query = "INSERT INTO Blog(title, content, user_id, created_at, updated_at, category_id, img_src) VALUES ('$title','$content','$user_id','$created_at','$updated_at', '$category_id', '$src')";
        $this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("Blog " . $title . "sucsessfully added");
        echo 'Успешно добавлено';
    }

	public function delete_blog($title)
    {
        $query = "DELETE FROM `Blog` WHERE Blog.title = '$title'";
       	$this->db->optionalQuery($query);
        $this->db->disconnect();
        Log::info("Blog " . $title . "sucsessfully deleted"); 
        echo 'Успешно удалено';
    }

}


?>