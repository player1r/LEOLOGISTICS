<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];    

    $mysql->query("UPDATE `users` SET `active_user` = '1' WHERE `id_user` = '$id'");
    
    $mysql->close();
      

    header("location:/static/html/admin_panel_users.php");
?>