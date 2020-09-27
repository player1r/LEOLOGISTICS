<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];    

    $mysql->query("UPDATE `details` SET `status_detail` = '1' WHERE `id_detail` = '$id'");
    $mysql->query("UPDATE `orders` SET `status_order` = '2' WHERE `id_detail` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_details.php");
?>