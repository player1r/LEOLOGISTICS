<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];

    $status = $mysql->query("SELECT `status_order` FROM `orders` WHERE `id_order` = '$id'");
    $st = $status->fetch_assoc();
    $status = $st['status_order'];

    if($status == 2) 
    {
        //ID склада
        $id_storage = $mysql->query("SELECT `id_storage` FROM `orders` WHERE `id_order` = '$id'");
        $i_s = $id_storage->fetch_assoc();
        $id_storage = $i_s['id_storage'];
        
        $mysql->query("UPDATE `orders` SET `status_order` = '3' WHERE `id_order` = '$id'");
        $mysql->query("UPDATE `orders` SET `date_success_order` = NOW() WHERE `id_order` = '$id'");
        
        $mysql->close();
    } 
    else 
    {
        $mysql->close();
    }
    

    header("location:/static/html/admin_panel_orders.php");
?>