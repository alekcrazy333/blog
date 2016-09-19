<?php
session_start();
if($_POST['check']){
    if($_POST['login'] == "admin" && $_POST['pass'] == "123" ){
        $_SESSION['name'] = "j";
    }else{
        echo '<h2>Вы не админ</h2>';
    }
}
if($_POST['logout']){
    unset($_SESSION['name']);
}
//require ("Classes/Autoload.php"); // вместо вызова всех остальных файлов классов // вызывем автолоад. он работае для всех классов, если прописать его в индексе
//equire "Classes/Autoloader.php";
//spl_autoload_register(['Autoloader','load']);
//var_dump(spl_autoload_functions());

require_once("Classes/DataBase.php");
require_once("Classes/User.php");
require_once("Classes/Category.php");
require_once("Classes/MyFunctions.php");
require_once("Classes/Blog.php");

$obj = new MyFunctions();
$cat_obj =  new Category();
$blog_obj = new Blog();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <?php
    if ($_SESSION['name'] == "") { ?>
        <form name="posts" enctype="multipart/form-data" action="" method="post"
              style="border: 2px solid black; margin: 10px; border-radius: 5px; padding: 10px">
            <div class="form-group">
                <label for="l_log">Login:</label>
                <input name="login" type="text" class="form-control" id="login">
            </div>
            <div class="form-group">
                <label for="p_pass">Pass:</label>
                <input name="pass" type="text" class="form-control" id="pass">
            </div>
            <input name="check" type="submit" value="Войти"/>
        </form>
    <?php } else { ?>
        <form class="col-md-offset-11" enctype="multipart/form-data" action="" method="post" style="border: 2px solid black; width: 120px; margin: 10px; border-radius: 5px; padding: 10px">
            <label for="l_log">Double click:</label>
            <input name="logout" type="submit" id="out" value="Logout">
        </form><br><br>
        <form name="posts" enctype="multipart/form-data" action="" method="post"
              style="border: 2px solid black; margin: 10px; border-radius: 5px; padding: 10px">
            <div class="form-group">
                <label for="cat">Add category:</label>
                <input name="category" type="text" id="cat_id">
                <input name="accept_cat" type="submit" id="accept_cat" value="Create category">
            </div>
            <div class="form-group">
                <label for="cat">Select category:</label>
                <select name="sel_cat">
                    <?php Category::select_category(); ?>
                </select>
                <input name="delete_cat" type="submit" id="del_cat" value="Delete category">
            </div>

            <div class="form-group">
                <label for="label_title">Title:</label>
                <input name="title" type="text" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="text_content" class="form-control" id="content" style="resize: vertical"></textarea>
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input name="image" type="file" id="img" value="BrowseImage">
            </div>
            <div class="form-group">
                <label for="user">User:</label>
                <select name="sel_user">
                    <?php User::select_user(); ?>
                </select>
                <input style="margin-left: 10px" name="delete_user" type="submit" id="del_user" value="Delete user">
            </div>
            <input name="accept" type="submit" value="Создать запись"/>
        </form>
        <form name="posts" enctype="multipart/form-data" action="" method="post"
              style="border: 2px solid black; margin: 10px; border-radius: 5px; padding: 10px">
            <div style="float: left; margin-right: 10px" class="form-group">
                <label for="blog">Blog:</label>
                <select name="sel_blog">
                    <?php $blog_obj->select_blog(); ?>
                </select>
            </div>
            <input name="delete" type="submit" value="Удалить запись"/>
        </form>
        <?php
    }
    ?>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    if ($_POST['accept_cat']) {
        if ($_POST['category'] != "") {    
            $cat_obj->add_category($_POST['category']);
        }
    }
    if ($_POST['delete_cat']) {
        if (isset($_POST['sel_cat'])) {
            $cat_obj->delete_category($_POST['sel_cat']);
        }
    }
    if ($_POST['accept']) {
        if (isset($_POST['sel_cat']) && $_POST['title'] != "" && $_POST['text_content'] != "" && isset($_POST['sel_user'])) {
            $user_id = User::select_userId($_POST['sel_user']);
            $category_id = Category::select_categoryId($_POST['sel_cat']);
            move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/img/' . $_FILES['image']['name']);
            $src = '/img/' . $_FILES['image']['name'];
            if ($src == "/img/") {
                $src = '/img/Empty_set.png';
                $blog_obj->add_blog($_POST['title'], $_POST['text_content'], $user_id, time(), time(), $category_id, $src);
            } else {
                $src = '/img/' . $_FILES['image']['name'];
                $blog_obj->add_blog($_POST['title'], $_POST['text_content'], $user_id, time(), time(), $category_id, $src);
            }
        }
    }
    if ($_POST['delete']) {
        if (isset($_POST['sel_blog'])) {
            $blog = $_POST['sel_blog'];
            echo $blog;
            $blog_obj->delete_blog($blog);
        }
    }
    if ($_POST['delete_user']) {
        if (isset($_POST['sel_user'])) {
            $user_obj = $_POST['sel_user'];
            $obj->delete_user($user_name);
        }
    }
}
?>
</body>
</html>