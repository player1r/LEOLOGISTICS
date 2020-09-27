<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];

    //Удаление детали
    $mysql->query("DELETE FROM `providers` WHERE `id_provider` = '$id'");

    $mysql->query("UPDATE `details` SET `status_detail` = '0' WHERE `id_provider` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_providers.php");
?>