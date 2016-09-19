<?php


 class MyFunctions
{
     private $login;
    private $db;
    function __construct()
    {
        $this->db = new DataBase("127.0.0.1", "root", "", "mydb");
        $this->db->connect();
    }

     public function select_category()
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
     public function create_category($name)
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        mysqli_query($connect,"INSERT INTO Categories(name) VALUES ('$name')");
        mysqli_close($connect);
        echo 'Успешно добавлено';
    }
     public function delete_category($name)
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        mysqli_query($connect,"DELETE FROM `Categories` WHERE Categories.name = '$name'");
        mysqli_close($connect);
        echo 'Успешно удалено';
    }
     public function select_user()
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $query2 = mysqli_query($connect,"SELECT * FROM User");
        $result = mysqli_fetch_all($query2);

        foreach($result as $r) {
            ?>
            <option><?echo $r['1']?></option>
            <?php
        }
        mysqli_close($connect);
    }
     public function delete_user($name)
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        mysqli_query($connect,"DELETE FROM `User` WHERE User.login = '$name'");
        mysqli_close($connect);
        echo 'Успешно удалено';
    }
     public function create_user($login, $name, $pass_hash, $pass_reset)
     {
         $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
         if(mysqli_connect_errno()){
             echo 'mysqli_connect_error()';
             exit();
         }
         mysqli_query($connect,"INSERT INTO User (login, name, pass_hash, pass_reset) VALUES ('$login', '$name', '$pass_hash', '$pass_reset')");
         mysqli_close($connect);
         echo 'Успешно добавлено';
     }

     public function select_userId($name){
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
     public function get_userName($id){
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $name = mysqli_query($connect,"SELECT * FROM User WHERE User.id = '$id'");
        $result = mysqli_fetch_all($name);
        mysqli_close($connect);
        foreach($result as $r) {
            return $r['1'];
        }
    }
     public function select_categoryId($name){
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
     public function get_categoryName($id){
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        $name = mysqli_query($connect,"SELECT * FROM Categories WHERE Categories.id = '$id'");
        $result = mysqli_fetch_all($name);
        mysqli_close($connect);
        foreach($result as $r) {
            return $r['1'];
        }
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

     public function create_blog($title,$content, $user_id, $created_at, $updated_at, $category_id, $src )
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }

        mysqli_query($connect,"INSERT INTO Blog(title, content, user_id, created_at, updated_at, category_id, img_src) VALUES ('$title','$content','$user_id','$created_at','$updated_at', '$category_id', '$src')");
        mysqli_close($connect);
        echo 'Успешно добавлено';
    }
     public function delete_blog($title)
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        echo '1';

        mysqli_query($connect,"DELETE FROM `Blog` WHERE Blog.title = '$title'");
        mysqli_close($connect);
        echo 'Успешно удалено';
    }
     public function check_admin($title)
    {
        $connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
        if(mysqli_connect_errno()){
            echo 'mysqli_connect_error()';
            exit();
        }
        echo '1';

        mysqli_query($connect,"DELETE FROM `Blog` WHERE Blog.title = '$title'");
        mysqli_close($connect);
        echo 'Успешно удалено';
    }
}
?>