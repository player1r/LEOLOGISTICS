<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_detail = $_POST['name_detail'];
        $size_detail = $_POST['size_detail'];
        $cost_detail = $_POST['cost_detail'];
        $name_provider = $_POST['name_provider'];

        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);   

        //ID поставщика
        $id_provider = $mysql->query("SELECT `id_provider` FROM `providers` WHERE `name_provider` = '$name_provider'");
        $i_p = $id_provider->fetch_assoc();
        $id_provider = $i_p['id_provider'];                 

        $mysql->query("INSERT INTO `details` (`name_detail`, `size_detail`, `id_provider`, `cost_detail`) VALUES ( '$name_detail', '$size_detail', '$id_provider', '$cost_detail')");
        
        $mysql->close();
            
        header("location:/static/html/admin_panel_details.php");       
    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_details.php#okno'>Назад</a>";    
    }




?>