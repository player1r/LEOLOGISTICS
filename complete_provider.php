<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];    

    $mysql->query("UPDATE `providers` SET `active_provider` = '1' WHERE `id_provider` = '$id'");
    $mysql->query("UPDATE `details` SET `status_detail` = '1' WHERE `id_provider` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_providers.php");
?>