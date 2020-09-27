<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_costumer = $_POST['name_costumer'];
        $email_costumer = $_POST['email_costumer'];
        $phone_costumer = $_POST['phone_costumer'];
        $ur_address_costumer = $_POST['ur_address_costumer'];
        $fiz_address_costumer = $_POST['fiz_address_costumer'];
        $agent_name_costumer = $_POST['agent_name_costumer'];
        $agent_phone_costumer = $_POST['agent_phone_costumer'];


        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);                  

        $mysql->query("INSERT INTO `costumers` (`name_costumer`, `email_costumer`, `phone_costumer`, `ur_address_costumer`,`fiz_address_costumer`,`agent_name_costumer`,`agent_phone_costumer`) VALUES ( '$name_costumer', '$email_costumer', '$phone_costumer', '$ur_address_costumer','$fiz_address_costumer','$agent_name_costumer','$agent_phone_costumer')");
        
        $mysql->close();
            
        header("location:/static/html/admin_panel_costumers.php");       
    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_costumers.php#okno'>Назад</a>";    
    }




?>