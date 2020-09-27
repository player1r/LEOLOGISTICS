<?php
    include 'config.php';

    //Проверка на пустоту
    if(isset($_POST))
    {
        $name_detail = $_POST['name_detail'];
        $kol_details_order = $_POST['kol_details_order'];
        $name_storage = $_POST['name_storage'];
        $name_costumer = $_POST['name_costumer'];
        $name_user = $_COOKIE['user'];

        //Подключение к БД
        $mysql = new mysqli($host,$user,$passw,$db);     

        //Размер заказа
        $size_detail = $mysql->query("SELECT `size_detail` FROM `details` WHERE `name_detail` = '$name_detail'");
        $s_d = $size_detail->fetch_assoc();
        $size_detail = $s_d['size_detail'];

        $capacity_order = $size_detail * $kol_details_order;       

        //ID склада
        $id_storage = $mysql->query("SELECT `id_storage` FROM `storage` WHERE `name_storage` = '$name_storage'");
        $i_s = $id_storage->fetch_assoc();
        $id_storage = $i_s['id_storage'];

        //Проверка на вместимость товара на складе 
        //Свободная вместимость склада
        $free_capacity_storage = $mysql->query("SELECT `free_capacity_storage` FROM `storage` WHERE `id_storage` = '$id_storage'");
        $f_c_s = $free_capacity_storage->fetch_assoc();
        $free_capacity_storage = $f_c_s['free_capacity_storage'];

        $capacity_storage = $free_capacity_storage - $capacity_order;

        if($capacity_storage >=0)
        {
            //ID детали
            $id_detail = $mysql->query("SELECT `id_detail` FROM `details` WHERE `name_detail` = '$name_detail'");
            $i_d = $id_detail->fetch_assoc();
            $id_detail = $i_d['id_detail'];          

            //ID заказчика
            $id_costumer = $mysql->query("SELECT `id_costumer` FROM `costumers` WHERE `name_costumer` = '$name_costumer'");
            $i_c = $id_costumer->fetch_assoc();
            $id_costumer = $i_c['id_costumer'];

            //ID пользователя
            $id_user = $mysql->query("SELECT `id_user` FROM `users` WHERE `name_user` = '$name_user'");
            $i_u = $id_user->fetch_assoc();
            $id_user = $i_u['id_user'];

            //Стоимость заказа
            $cost_detail = $mysql->query("SELECT `cost_detail` FROM `details` WHERE `name_detail` = '$name_detail'");
            $c_d = $cost_detail->fetch_assoc();
            $cost_detail = $c_d['cost_detail'];

            $cost_order = $cost_detail * $kol_details_order;

            $mysql->query("INSERT INTO `orders` (`id_detail`, `kol_details_order`, `id_storage`, `capacity_order`, `id_costumer`, `id_user`, `cost_order`) VALUES ( '$id_detail', '$kol_details_order', '$id_storage', '$capacity_order', '$id_costumer', '$id_user', '$cost_order')");
            $mysql->query("UPDATE `storage` SET `free_capacity_storage` = '$capacity_storage' WHERE `id_storage` = '$id_storage'");

            $mysql->close();
            
            header("location:/static/html/admin_panel_orders.php");
        }
        else
        {
            echo "В указанном складе недостаточно места для хранения Вашего заказа!</br>Пожалуйста, измените склад хранения.</br><a href='../../static/html/admin_panel_orders.php#okno'>Назад</a>";    

            $mysql->close();
        }     
        

    }
    else
    {
        echo "Ошибочный запрос!</br>Пожалуйста, проверьте корректность введённых данных.</br><a href='../../static/html/admin_panel_orders.php#okno'>Назад</a>";    
    }




?>