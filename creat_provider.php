<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_provider = $_POST['name_provider'];
        $email_provider = $_POST['email_provider'];
        $phone_provider = $_POST['phone_provider'];
        $ur_address_provider = $_POST['ur_address_provider'];
        $fiz_address_provider = $_POST['fiz_address_provider'];
        $agent_name_provider = $_POST['agent_name_provider'];
        $agent_phone_provider = $_POST['agent_phone_provider'];


        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);                  

        $mysql->query("INSERT INTO `providers` (`name_provider`, `email_provider`, `phone_provider`, `ur_address_provider`,`fiz_address_provider`,`agent_name_provider`,`agent_phone_provider`) VALUES ( '$name_provider', '$email_provider', '$phone_provider', '$ur_address_provider','$fiz_address_provider','$agent_name_provider','$agent_phone_provider')");
        
        $mysql->close();
            
        header("location:/static/html/admin_panel_providers.php");       
    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_providers.php#okno'>Назад</a>";    
    }




?>