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
<body class="main">

<?php

$menu = array(
    array("id" => 1, "url" => "/index.php", "name" => "Home"),
    array("id" => 2, "url" => "/contact.php", "name" => "Contact"),
    array("id" => 3, "url" => "/blog.php", "name" => "Blog"),
    array("id" => 4, "url" => "/about.php", "name" => "About"),
    array("id" => 5, "url" => "/registration.php", "name" => "Registration"),
);

$pageId = isset($_GET["id"]) ? $_GET["id"] : 1;

foreach ($menu as $m) {
    if ($m['id'] == $pageId)
        $path = $m['url'];
}
?>
<div class="container" >
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">AlexBlog</a>
            </div>
            <ul class="nav navbar-nav">
                <?php
                foreach ($menu as $m): ?>
                    <li class="menu-item">
                        <a href="/index.php?id=<?= $m['id'] ?>"><?= $m['name'] ?></a>
                    </li>
                    <?php
                endforeach;
                ?>
            </ul>
        </div>
    </nav>
    <?php
    if ($pageId == 1):
        ?>
        <style>
             .main{
                background-image: url("konoplya.jpg");
            }
        </style>
        <div style=" padding: 10px; margin: 10px; " class="row">
            <div class="col-md-12">
                <h2 style="color: white; float: left; margin-right: 10px;">This is My VLOG</h2>
                    <img src="I.jpg" />
            </div>
        </div>
    <?php else:
        include($path);
    endif;
    ?>
</div>
<?php
?>
</body>
</html>
