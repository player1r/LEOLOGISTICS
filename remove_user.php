<?php

    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    $id = $_POST['id'];

    //Удаление детали
    $mysql->query("DELETE FROM `users` WHERE `id_user` = '$id'");

    
    $mysql->close();
      

    header("location:/static/html/admin_panel_users.php");
?>