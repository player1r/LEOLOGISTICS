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
                            <h1>Новая деталь</h1>

                            <!-- Форма создания заказа -->
                            <form method="POST" action="../../../static/php/create_detail.php">
                                
                                <input type="text" name="name_detail" placeholder="Название детали"></br>  
                                <input type="number" name="size_detail" min="0" step="0.0001" placeholder="Размер детали, м3"></br>  
                                <input type="number" name="cost_detail" step="0.01" placeholder="Стоимость детали, ₽"></br>  
                                

                                <select name="name_provider">
                                <option value="" disabled selected hidden>Производитель</option>
                                <?php while($mas = mysqli_fetch_array($name_providers))
                                {?>
                                    <option><?echo $mas['name_provider'];?></option>
                                <?}?>
                                </select></br>

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
                        <h1>Реестр деталей</h1>

                        <!-- Reestr -->
                        <div class="reestr">     
                            <div class="head">
                                <h2>Количество записей: <?echo $general_number_details;?></h2> 

                                    <div>
                                        <form method="POST" action="admin_panel_details_1.php">
                                            <input type="text" name="name" placeholder="Поиск по названию">
                                            <button type="submit">
                                                <img src="../assets/images/search.png" title="Поиск по названию" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button>
                                        </form>
                                    </div>

                                <div>
                                    <a href="../../../static/php/all_details.php">Все данные</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#okno">Добавить деталь</a>   
                                </div>
                            </div> 

                            <?php       
    
                                //Подключение к БД
                                $mysql = new mysqli($host,$user,$passw,$db);

                                //Запрос на вывод данных
                                if($search == 1)
                                {
                                    $result = $mysql->query("SELECT `d`.`id_detail`, `d`.`name_detail`, `d`.`size_detail`,`d`.`cost_detail`, `p`.`name_provider`,`d`.`status_detail` FROM `details` `d` JOIN `providers` `p` ON (`d`.`id_provider` = `p`.`id_provider`) WHERE `d`.`name_detail` = '$name' ORDER BY `d`.`name_detail` ASC");
                                }
                                else
                                {
                                    $result = $mysql->query("SELECT `d`.`id_detail`, `d`.`name_detail`, `d`.`size_detail`,`d`.`cost_detail`, `p`.`name_provider`,`d`.`status_detail` FROM `details` `d` JOIN `providers` `p` ON (`d`.`id_provider` = `p`.`id_provider`) ORDER BY `d`.`name_detail` ASC");
                                }
                            ?>

                            <!-- Reestr -->
                            <table width="100%">
                                <tr>
                                    <th height="30px">Номер</th>
                                    <th>Название</th>
                                    <th>Размер</th>
                                    <th>Стоимость</th>
                                    <th>Производитель</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>

                            <!-- Запуск выводы данных по запросу -->
                            <?
                                while ($mas = mysqli_fetch_array($result)){
                            ?>

                                <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">	
                                    <td><? echo $mas['id_detail'];?></td>
                                    <td><? echo $mas['name_detail'];?></td>
                                    <td><? echo $mas['size_detail'];?> м3</td>
                                    <td><? echo $mas['cost_detail'];?> ₽</td>
                                    <td><? echo $mas['name_provider'];?></td>
                                    <td><? if ($mas['status_detail'] == 1) {echo "Доступно";} else {echo "Не доступно";}?></td>

                                    <td style="height: 4em; display: flex; flex-direction: row; align-items: center;">
                                        <!-- Кнопка "Удалить деталь" -->
                                        <form method="post" action="../../../static/php/remove_detail.php" target="_self" onsubmit="return confirm('Выбранная деталь будет безвозвратно удалена. Выполнить действие?');">
                                            <button type="submit" name="id" value="<?=$mas['id_detail'];?>">
                                                <img src="../assets/images/delete.png" title="Удалить деталь" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form> 

                                        <!-- Кнопка "Недоступна деталь" -->
                                        <form method="post" action="../../../static/php/cancel_detail.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_detail'];?>">
                                                <img src="../assets/images/cancel.png" title="Отменить деталь" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>

                                        <!-- Кнопка "Активировать деталь" -->
                                        <form method="post" action="../../../static/php/active_detail.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_detail'];?>">
                                                <img src="../assets/images/complete.png" title="Активировать деталь" style="width: 20px; height: 20px; margin-right: 10px;">
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
