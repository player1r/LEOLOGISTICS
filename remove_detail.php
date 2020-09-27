<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];

    //Удаление детали
    $mysql->query("DELETE FROM `details` WHERE `id_detail` = '$id'");

    $mysql->query("UPDATE `orders` SET `status_order` = '0' WHERE `id_detail` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_details.php");
?>