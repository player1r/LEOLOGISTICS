<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];    

    $mysql->query("UPDATE `storage` SET `active_storage` = '1' WHERE `id_storage` = '$id'");
    $mysql->query("UPDATE `orders` SET `status_order` = '2' WHERE `id_storage` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_storage.php");
?>