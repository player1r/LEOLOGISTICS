<?php     

    if($_COOKIE['user'] == ''){
        header ("location:/static/html/enter.html");
    } else {          
        
    include '../php/static_for_admin_panel.php';

?>        
            

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LeoLogistics">
        <meta name="yandex-verification" content="7456ff8c7bf2a5b9" />

        <link rel="stylesheet" href="../assets/theme.min.css">

        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <title>Панель управления | LeoLogistics</title>

    </head>
    <body background="white">

    <div class="main_container">
            <!-- Header -->
            <div class="header">
                <div class="container">
                    <div class="title">
                        <a href="../index.php" style="color: #000769; font-family: 'Oswald'; font-size: 20px;" onmouseover="this.style.color='#00a8f7';" onmouseout="this.style.color='#000769';">LEOLOGISTICS</a>
                        <a href="admin_panel.php" style="font-family: 'Helvetica'; font-size: 24px; color: #000769;" onmouseover="this.style.color='#ff045a';" onmouseout="this.style.color='#000769';">DASHBOARD</a>
                    </div>

                    <div class="menu">
                        <p style="color: #00a8f7; font-family: 'Helvetica';}"><?=$_COOKIE['user']?></p>
                        
                        <a href="/static/php/exit.php">Выйти</a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="main_part_admin_panel">
                <!-- Left border -->
                <div class="border"></div>

                <!-- Central part -->
                <div class="center_part">
                    <!-- Navigation -->
                    <!-- <div class="navigation">
                        <a href="admin_panel_orders.php">Заказы</a>
                        <a href="admin_panel_details.php">Детали</a>
                        <a href="admin_panel_storage.php">Склады</a>
                        <a href="admin_panel_providers.php">Производители</a>
                        <a href="admin_panel_costumers.php">Заказчики</a>
                        <a href="admin_panel_users.php">Пользователи</a>
                    </div> -->

                    <!-- Stat data -->
                    <div class="dashboard">
                        <h1>Статистические данные</h1>

                        <div class="statistica">
                            <!-- Orders -->
                            <div class="item">
                                <h1>Заказы</h1>
                                <h2>Всего: <?=$general_number_orders?></h2>
                                <h2 class="active">Активные: <?=$active_number_orders?></h2>
                                <h2 style="color: orange;">На складе: <?=$storage_number_orders?></h2>
                                <h2 class="cancel">Отменённые: <?=$cancel_number_orders?></h2>
                                <h2 class="success">Выполненные: <?=$success_number_orders?></h2>
                            </div>

                            <!-- Details -->
                            <div class="item">
                                <h1>Детали</h1>
                                <h2>Всего: <?=$general_number_details?></h2>
                                <h2 class="active">Доступные для заказа: <?=$active_number_details?></h2>
                                <h2 class="no_active">Недоступны для заказа: <?=$cancel_number_details?></h2>
                            </div>

                            <!-- Storage -->
                            <div class="item">
                                <h1>Склады</h1>
                                <h2>Всего: <?=$general_number_storage?></h2>
                                <h2 class="active">Функционирующие: <?=$active_number_storage?></h2>
                                <h2 class="no_active">Недоступны для доставки: <?=$empty_number_storage?></h2>
                            </div>

                            <!-- Providers -->
                            <div class="item">
                                <h1>Производители</h1>
                                <h2>Всего: <?=$general_number_providers?></h2>
                                <h2 class="active">Активные: <?=$active_number_providers?></h2>
                                <h2 class="no_active">Заблокированные: <?=$bloked_number_providers?></h2>
                            </div>

                            <!-- Costumers -->
                            <div class="item">
                                <h1>Заказчики</h1>
                                <h2>Всего: <?=$general_number_costumers?></h2>
                                <h2 class="active">Активные: <?=$active_number_costumers?></h2>
                                <h2 class="no_active">Заблокированные: <?=$bloked_number_costumers?></h2>
                            </div>

                            <!-- Users -->
                            <div class="item">
                                <h1>Пользователи</h1>
                                <h2>Всего: <?=$general_number_users?></h2>
                                <h2 class="active">Активные: <?=$active_number_users?></h2>
                                <h2 class="no_active">Заблокированные: <?=$bloked_number_users?></h2>
                            </div>

                            <!-- Closed PHP -->
                            <?php }?>

                        </div>
                    </div>
                    
                </div>
                
                

                <!-- Right border -->
                <div class="border"></div>
            </div>
        </div>
        


    </body>
</html>
