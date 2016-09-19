<?php
require "functions.php";
$connect = mysqli_connect("127.0.0.1", 'root', '', 'mydb');
if(mysqli_connect_errno()){
    echo 'mysqli_connect_error()';
    exit();
}
$query2 = mysqli_query($connect,"SELECT * FROM Blog");
$result = mysqli_fetch_all($query2);
$month = ['январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'];
foreach($result as $r) {
    $time = $r['4'];
    $months = (int)date('m',$r['4'] ) - 1;
    ?>
    <div style="border: 2px solid aquamarine; border-radius: 8px; padding: 10px; margin: 10px; background-color: cornsilk" class="row">
        <div class="col-md-12" style="width: 75%; float: left">
            <h2> <? echo $r['1']?></h2>
            <div style="margin-right: 150px; font-style: italic; font-size: 16px; color: red; float: left">Time: <? echo $month["$months"] . " "
                    . (int)date('d',$r['4'] ) . ", " . (int)date('Y',$r['4'] ) . " - " . (new DateTime("@$time"))->setTimezone(new DateTimeZone('Europe/Kiev'))->format("H:i")?></div>
            <div style="font-size: 16px; margin-right: 150px; color: red; float: left">Author: <?php echo get_userName($r['3']) ?></div>
            <div style="font-size: 16px; color: red">Category: <?php echo get_categoryName($r['6']) ?></div><br>
            <textarea name="blog_content" class="form-control" id="b_content" disabled style="resize: vertical"><? echo $r['2']?></textarea>
        </div>
        <div class="col-md-12" style="width: 20%">
            <img width="150px" height="200px" src="<?=$r['7']?>" alt=""/>
        </div>
    </div>
    <?php
}
mysqli_close($connect);

?>
