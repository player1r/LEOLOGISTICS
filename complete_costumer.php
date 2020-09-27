<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];    

    $mysql->query("UPDATE `costumers` SET `active_costumer` = '1' WHERE `id_costumer` = '$id'");
    $mysql->query("UPDATE `orders` SET `status_order` = '1' WHERE `id_costumer` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_costumers.php");
?>