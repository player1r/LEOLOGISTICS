<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_storage = $_POST['name_storage'];
        $capacity_storage = $_POST['capacity_storage'];
        $address_storage = $_POST['address_storage'];

        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);   
               

        $mysql->query("INSERT INTO `storage` (`name_storage`, `capacity_storage`,`free_capacity_storage`,`address_storage`) VALUES ( '$name_storage', '$capacity_storage', '$capacity_storage', '$address_storage')");
        
        $mysql->close();
            
        header("location:/static/html/admin_panel_storage.php");       
    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_storage.php#okno'>Назад</a>";    
    }




?>