<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_user = $_POST['name_user'];
        $email_user = $_POST['email_user'];
        $password_user = $_POST['password_user'];

        $password_md5 = md5($password_user);

        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);              

        $mysql->query("INSERT INTO `users` (`name_user`, `email_user`, `password_user`) VALUES ( '$name_user', '$email_user', '$password_md5')");
        
        $mysql->close();
            
        header("location:/static/html/admin_panel_users.php");       
    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_users.php#okno'>Назад</a>";    
    }




?>