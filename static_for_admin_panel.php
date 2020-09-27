<?php

    include 'config.php';      
    
    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Запросы к таблице Заказы
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `orders`");
        $res = $result->fetch_assoc();
        $general_number_orders = $res['COUNT(*)'];

        //Активные
        $result = $mysql->query("SELECT COUNT(*) FROM `orders` WHERE `status_order` = '2'");
        $res = $result->fetch_assoc();
        $active_number_orders = $res['COUNT(*)'];

        //Отменённые
        $result = $mysql->query("SELECT COUNT(*) FROM `orders` WHERE `status_order` = '1'");
        $res = $result->fetch_assoc();
        $cancel_number_orders = $res['COUNT(*)'];

        //На складе
        $result = $mysql->query("SELECT COUNT(*) FROM `orders` WHERE `status_order` = '3'");
        $res = $result->fetch_assoc();
        $storage_number_orders = $res['COUNT(*)'];

        //Выполненные
        $result = $mysql->query("SELECT COUNT(*) FROM `orders` WHERE `status_order` = '4'");
        $res = $result->fetch_assoc();
        $success_number_orders = $res['COUNT(*)'];

    //Запросы к таблице Детали
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `details`");
        $res = $result->fetch_assoc();
        $general_number_details = $res['COUNT(*)'];

        //Активные
        $result = $mysql->query("SELECT COUNT(*) FROM `details` WHERE `status_detail` = '1'");
        $res = $result->fetch_assoc();
        $active_number_details = $res['COUNT(*)'];

        //Отменённые
        $result = $mysql->query("SELECT COUNT(*) FROM `details` WHERE `status_detail` = '0'");
        $res = $result->fetch_assoc();
        $cancel_number_details = $res['COUNT(*)'];

    //Запросы к таблице Склады
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `storage`");
        $res = $result->fetch_assoc();
        $general_number_storage = $res['COUNT(*)'];

        //Функционирующие
        $result = $mysql->query("SELECT COUNT(*) FROM `storage` WHERE `active_storage` = '1'");
        $res = $result->fetch_assoc();
        $active_number_storage = $res['COUNT(*)'];

        //Пустые
        $result = $mysql->query("SELECT COUNT(*) FROM `storage` WHERE `active_storage` = '0'");
        $res = $result->fetch_assoc();
        $empty_number_storage = $res['COUNT(*)'];

    //Запросы к таблице Поставщики
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `providers`");
        $res = $result->fetch_assoc();
        $general_number_providers = $res['COUNT(*)'];

        //Активные
        $result = $mysql->query("SELECT COUNT(*) FROM `providers` WHERE `active_provider` = '1'");
        $res = $result->fetch_assoc();
        $active_number_providers = $res['COUNT(*)'];

        //Заблокированные
        $result = $mysql->query("SELECT COUNT(*) FROM `providers` WHERE `active_provider` = '0'");
        $res = $result->fetch_assoc();
        $bloked_number_providers = $res['COUNT(*)'];

    //Запросы к таблице Заказчики
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `costumers`");
        $res = $result->fetch_assoc();
        $general_number_costumers = $res['COUNT(*)'];

        //Активные
        $result = $mysql->query("SELECT COUNT(*) FROM `costumers` WHERE `active_costumer` = '1'");
        $res = $result->fetch_assoc();
        $active_number_costumers = $res['COUNT(*)'];

        //Заблокированные
        $result = $mysql->query("SELECT COUNT(*) FROM `costumers` WHERE `active_costumer` = '0'");
        $res = $result->fetch_assoc();
        $bloked_number_costumers = $res['COUNT(*)'];

    //Запросы к таблице Пользователи
        //Общее число
        $result = $mysql->query("SELECT COUNT(*) FROM `users`");
        $res = $result->fetch_assoc();
        $general_number_users = $res['COUNT(*)'];

        //Активные
        $result = $mysql->query("SELECT COUNT(*) FROM `users` WHERE `active_user` = '1'");
        $res = $result->fetch_assoc();
        $active_number_users = $res['COUNT(*)'];

        //Заблокированные
        $result = $mysql->query("SELECT COUNT(*) FROM `users` WHERE `active_user` = '0'");
        $res = $result->fetch_assoc();
        $bloked_number_users = $res['COUNT(*)'];


    //Сведения для заказа
    $name_details = $mysql->query("SELECT `name_detail` FROM `details`");
    $name_storages = $mysql->query("SELECT `name_storage` FROM `storage` WHERE `active_storage` = '1'");
    $name_costumers = $mysql->query("SELECT `name_costumer` FROM `costumers` WHERE `active_costumer` = '1'");

    //Сведения для детали
    $name_providers = $mysql->query("SELECT `name_provider` FROM `providers` WHERE `active_provider` = '1'");

                            
        
    
    $mysql->close();
?>