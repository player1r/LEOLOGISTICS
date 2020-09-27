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
                        <div class="form_popup">
                            <a href="#" class="close"><img src="../assets/images/delete.png" title="Закрыть форму" width="20px" height="20px"></a>
                            <h1>Новый пункт хранения</h1>

                            <!-- Форма создания заказа -->
                            <form method="POST" action="../../../static/php/create_storage.php">
                                
                                <input type="text" name="name_storage" placeholder="Название склада"></br>  
                                <input type="number" name="capacity_storage" min="0" step="0.0001" placeholder="Объём склада, м3"></br>  
                                <input type="text" name="address_storage" placeholder="Адрес"></br>  

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
                        <h1>Реестр пунктов хранения</h1>

                        <!-- Reestr -->
                        <div class="reestr">     
                            <div class="head">
                                <h2>Количество записей: <?echo $general_number_storage;?></h2> 
                                <div>
                                    <a href="../../../static/php/all_storage.php">Все данные</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#okno">Добавить пункт хранения</a>   
                                </div>
                            </div> 

                            <?php       
    
                                //Подключение к БД
                                $mysql = new mysqli($host,$user,$passw,$db);

                                //Запрос на вывод данных
                                $result = $mysql->query("SELECT `id_storage`,`name_storage`,`capacity_storage`,`free_capacity_storage`,`address_storage`,`active_storage` FROM `storage` ORDER BY `free_capacity_storage` DESC");
                            ?>

                            <!-- Reestr -->
                            <table width="100%">
                                <tr>
                                    <th height="30px">Номер</th>
                                    <th>Название</th>
                                    <th>Свободное место</th>
                                    <th>Адрес</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>

                            <!-- Запуск выводы данных по запросу -->
                            <?
                                while ($mas = mysqli_fetch_array($result)){
                            ?>

                                <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">	
                                    <td><? echo $mas['id_storage'];?></td>
                                    <td><? echo $mas['name_storage'];?></td>
                                    <td><? echo $mas['free_capacity_storage'], " м3 /", $mas['capacity_storage'];?> м3</td>
                                    <td><? echo $mas['address_storage'];?></td>
                                    <td><? if ($mas['active_storage'] == 1) {echo "Функционирует";} else {echo "Закрыт";}?></td>

                                    <td style="height: 4em; display: flex; flex-direction: row; align-items: center;">
                                        <!-- Кнопка "Удалить помещение" -->
                                        <form method="post" action="../../../static/php/remove_storage.php" target="_self" onsubmit="return confirm('Выбранный склад будет безвозвратно удалён. Выполнить действие?');">
                                            <button type="submit" name="id" value="<?=$mas['id_storage'];?>">
                                                <img src="../assets/images/delete.png" title="Удалить склад" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form> 

                                        <!-- Кнопка "Дезактивировать помещение" -->
                                        <form method="post" action="../../../static/php/cancel_storage.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_storage'];?>">
                                                <img src="../assets/images/cancel.png"  title="Отменить склад" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>

                                        <!-- Кнопка "Активировать помещение" -->
                                        <form method="post" action="../../../static/php/complete_storage.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_storage'];?>">
                                                <img src="../assets/images/complete.png" title="Активировать склад" style="width: 20px; height: 20px;">
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
