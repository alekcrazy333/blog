
<form name="posts" enctype="multipart/form-data" action="" method="post"
      style="border: 2px solid black; margin: 10px; border-radius: 5px; padding: 10px">
    <div class="form-group">
        <label for="cat">Login:</label>
        <input name="login" type="text" class="form-control" id="log">
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input name="name" type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="pass">Password:</label>
        <input name="password" type="text" class="form-control" id="password"><br>
        <input name="register_user" type="submit" id="reg_user" value="RegisterUser">
    </div>
</form>
<?php
include("Classes/User.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['register_user']) {
        $login = $_POST['login'];
        $name = $_POST['name'];
        $pass = $_POST['password'];
        $user_class = new User($login,$name,$pass);
        $user_class->addUser();
    }
}
?>