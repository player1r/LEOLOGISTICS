<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];

    $status = $mysql->query("SELECT `status_order` FROM `orders` WHERE `id_order` = '$id'");
    $st = $status->fetch_assoc();
    $status = $st['status_order'];

    if($status == 1) {        
        $mysql->query("DELETE FROM `orders` WHERE `orders`.`id_order` = '$id'");
        $mysql->close();
    }
    else {

        //Размер заказа
        $capacity_order = $mysql->query("SELECT `capacity_order` FROM `orders` WHERE `id_order` = '$id'");
        $c_o = $capacity_order->fetch_assoc();
        $capacity_order = $c_o['capacity_order'];

        //ID склада
        $id_storage = $mysql->query("SELECT `id_storage` FROM `orders` WHERE `id_order` = '$id'");
        $i_s = $id_storage->fetch_assoc();
        $id_storage = $i_s['id_storage'];

        //Свободная вместимость склада
        $free_capacity_storage = $mysql->query("SELECT `free_capacity_storage` FROM `storage` WHERE `id_storage` = '$id_storage'");
        $f_c_s = $free_capacity_storage->fetch_assoc();
        $free_capacity_storage = $f_c_s;

        //Вместимость склада после удаления заказа
        $capacity_storage = $f_c_s + $capacity_order;
        $mysql->query("UPDATE `storage` SET `free_capacity_storage` = '$capacity_storage' WHERE `id_storage` = '$id_storage'");

        //Удаление заказа
        $mysql->query("DELETE FROM `orders` WHERE `id_order` = '$id'");
    
        $mysql->close();
    }   

    header("location:/static/html/admin_panel_orders.php");
?>