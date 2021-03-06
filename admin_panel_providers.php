<?php     

    if($_COOKIE['user'] == ''){
        header ("location:/static/html/enter.html");
    } else {          
        
    include '../php/static_for_admin_panel.php';
    include '../php/config.php';

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
                        <!-- Closed PHP -->
                        <?php }?>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="main_part_admin_panel">
                <!-- Left border -->
                <div class="border"></div>

                <!-- Central part -->
                <div class="center_part">
                    <!-- Всплывающее окно -->
                    <div id="okno">
                        <div class="form_popup" style="height: 95%;">
                            <a href="#" class="close"><img src="../assets/images/delete.png" title="Закрыть форму" width="20px" height="20px"></a>
                            <h1>Новый производитель</h1>

                            <!-- Форма создания заказа -->
                            <form method="POST" action="../../../static/php/creat_provider.php">
                                
                                <input type="text" name="name_provider" placeholder="Название компании"></br>  
                                <input type="text" name="email_provider" placeholder="Контактный адрес эл. почты"></br>  
                                <input type="number" name="phone_provider" placeholder="Контактный телефон"></br>  
                                <input type="text" name="ur_address_provider" placeholder="Юридический адрес"></br> 
                                <input type="text" name="fiz_address_provider" placeholder="Фактический адрес"></br> 
                                <input type="text" name="agent_name_provider" placeholder="ФИО представилея"></br> 
                                <input type="number" name="agent_phone_provider" placeholder="Телефон представителя"></br> 

                                <input type="submit" value="Добавить"> 
                            </form>                            
                        </div>
                    </div>



                    <!-- Navigation -->
                    <div class="navigation">
                        <a href="admin_panel_orders.php">Заказы</a>
                        <a href="admin_panel_details.php">Детали</a>
                        <a href="admin_panel_storage.php">Склады</a>
                        <a href="admin_panel_providers.php">Производители</a>
                        <a href="admin_panel_costumers.php">Заказчики</a>
                        <a href="admin_panel_users.php">Пользователи</a>
                    </div>

                    <!-- dashboard -->
                    <div class="dashboard">
                        <h1>Реестр производителей</h1>

                        <!-- Reestr -->
                        <div class="reestr">     
                            <div class="head">
                                <h2>Количество записей: <?echo $general_number_providers;?></h2> 
                                <div>
                                    <!-- <a href="#">Все данные</a>&nbsp;&nbsp;&nbsp; -->
                                    <a href="#okno">Добавить производителя</a>   
                                </div>
                            </div> 

                            <?php       
    
                                //Подключение к БД
                                $mysql = new mysqli($host,$user,$passw,$db);

                                //Запрос на вывод данных
                                $result = $mysql->query("SELECT `id_provider`,`name_provider`,`email_provider`,`phone_provider`,`ur_address_provider`,`fiz_address_provider`,`agent_name_provider`,`agent_phone_provider`,`active_provider` FROM `providers` ORDER BY `active_provider` DESC");
                            ?>

                            <!-- Reestr -->
                            <table width="100%">
                                <tr>
                                    <th height="30px" style="padding-right: 5px;">Номер</th>
                                    <th style="padding-right: 5px;">Название компании</th>
                                    <th style="padding-right: 5px;">Контакты</th>
                                    <th style="padding-right: 5px;">Юридический адрес</th>
                                    <th style="padding-right: 5px;">Фактический адрес</th>
                                    <th style="padding-right: 5px;">Представитель</th>
                                    <th style="padding-right: 5px;">Контакты представителя</th>
                                    <th style="margin-right: 10px;">Статус</th>
                                    <th style="padding-right: 5px;">Действия</th>
                                </tr>

                            <!-- Запуск выводы данных по запросу -->
                            <?
                                while ($mas = mysqli_fetch_array($result)){
                            ?>

                                <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">	
                                    <td><? echo $mas['id_provider'];?></td>
                                    <td><? echo $mas['name_provider'];?></td>
                                    <td><? echo $mas['email_provider'], " / ", $mas['phone_provider'];?></td>
                                    <td><? echo $mas['ur_address_provider'];?></td>
                                    <td><? echo $mas['fiz_address_provider'];?></td>
                                    <td><? echo $mas['agent_name_provider'];?></td>
                                    <td><? echo $mas['agent_phone_provider'];?></td>
                                    <td><? if ($mas['active_provider'] == 1) {echo "Активный";} else {echo "Заблокирован";}?></td>

                                    <td style="height: 4em; display: flex; flex-direction: row; align-items: center;">
                                        <!-- Кнопка "Удалить производителя" -->
                                        <form method="post" action="../../../static/php/remove_provider.php" target="_self" onsubmit="return confirm('Выбранный производитель будет безвозвратно удалён. Выполнить действие?');">
                                            <button type="submit" name="id" value="<?=$mas['id_provider'];?>">
                                                <img src="../assets/images/delete.png" title="Удалить производителя" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form> 

                                        <!-- Кнопка "Дезактивировать производителя" -->
                                        <form method="post" action="../../../static/php/cancel_provider.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_provider'];?>">
                                                <img src="../assets/images/cancel.png"  title="Заблокировать производителя" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>

                                        <!-- Кнопка "Активировать производителя" -->
                                        <form method="post" action="../../../static/php/complete_provider.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_provider'];?>">
                                                <img src="../assets/images/complete.png" title="Активировать производителя" style="width: 20px; height: 20px;">
                                            </button> 
                                        </form>
                                    </td>
                                </tr>
      
                            <!-- Конец PHP -->
                            <? }?>
                            </table>

                        </div>
                    </div>
                    
                </div>
                
                

                <!-- Right border -->
                <div class="border"></div>
            </div>
        </div>
        


    </body>
</html>
