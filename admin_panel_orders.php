<?php     

    if($_COOKIE['user'] == ''){
        header ("location:/static/html/enter.html");
    } else {          
        
    include '../php/static_for_admin_panel.php';
    include '../php/config.php';

    // if(!empty($_POST))
    // {
    //         $date = $_POST['date'];
    //         $date_s->add(new DateInterval('PT00H01S'));
    //         $date_f->add(new DateInterval('PT23H59M59S'));
    //         $search = 1;
        
    // }
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

        <title>Реестр заказов | LeoLogistics</title>

    </head>
    <body background="white">

    <div class="main_container" style="background-color: white;">
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
                            <h1>Оформление заказа</h1>

                            <!-- Форма создания заказа -->
                            <form method="POST" action="../../../static/php/create_order.php">
                                
                                <select name="name_detail">
                                <option value="" disabled selected hidden>Деталь</option>
                                <?php while($mas = mysqli_fetch_array($name_details))
                                {?>
                                    <option><?echo $mas['name_detail'];?></option>
                                <?}?>
                                </select></br>

                                <input type="number" name="kol_details_order" placeholder="Количество деталей"></br>  

                                <select name="name_storage">
                                <option value="" disabled selected hidden>Склад хранения</option>
                                <?php while($mas = mysqli_fetch_array($name_storages))
                                {?>
                                    <option><?echo $mas['name_storage'];?></option>
                                <?}?>
                                </select></br>

                                <select name="name_costumer">
                                <option value="" disabled selected hidden>Заказчик</option>
                                <?php while($mas = mysqli_fetch_array($name_costumers))
                                {?>
                                    <option><?echo $mas['name_costumer'];?></option>
                                <?}?>
                                </select></br>

                                <input type="submit" value="Создать"> 
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
                        <h1>Реестр заказов</h1>

                        <!-- Reestr -->
                        <div class="reestr">     
                            <div class="head">
                                <h2>Количество <?=$date;?> записей: <?echo $general_number_orders;?></h2> 

                                <!-- <div>
                                    <form method="POST" <? echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                                        <input type="date" name="date" placeholder="Дата создания" value="<?=$date;?>">
                                        <button type="submit" title="Поиск по дате">
                                            <img src="../assets/images/search.png" style="width: 20px; height: 20px; margin-right: 10px;">
                                        </button>
                                    </form>
                                </div> -->

                                <div>
                                    <a href="../../../static/php/all_orders.php">Все данные</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#okno">Создать заказ</a>   
                                </div>
                            </div> 

                            

                            <?php       
    
                                //Подключение к БД
                                $mysql = new mysqli($host,$user,$passw,$db);

                                //Запрос на вывод данных
                                if($search == 1)
                                {
                                    $result = $mysql->query("SELECT `o`.`id_order`, `d`.`name_detail`, `o`.`kol_details_order`,`o`.`capacity_order`, `c`.`name_costumer`, `o`.`cost_order`, `o_s`.`name_status`, `o`.`date_order` FROM `orders` `o` JOIN `details` `d` ON (`d`.`id_detail` = `o`.`id_detail`) JOIN `costumers` `c` ON (`c`.`id_costumer` = `o`.`id_costumer`) JOIN `order_status` `o_s` ON (`o_s`.`id_status` = `o`.`status_order`) WHERE `o`.`date_order` > '$date_s' AND `o`.`date_order` < '$date_f' ORDER BY `o`.`date_order` DESC");
                                }
                                else 
                                {
                                    $result = $mysql->query("SELECT `o`.`id_order`, `d`.`name_detail`, `o`.`kol_details_order`,`o`.`capacity_order`, `c`.`name_costumer`, `o`.`cost_order`, `o_s`.`name_status`, `o`.`date_order` FROM `orders` `o` JOIN `details` `d` ON (`d`.`id_detail` = `o`.`id_detail`) JOIN `costumers` `c` ON (`c`.`id_costumer` = `o`.`id_costumer`) JOIN `order_status` `o_s` ON (`o_s`.`id_status` = `o`.`status_order`) ORDER BY `o`.`date_order` DESC");
                                }
                            ?>

                            <!-- Reestr -->
                            <table width="100%">
                                <tr>
                                    <th height="30px">Номер</th>
                                    <th>Состав</th>
                                    <th>Размер</th>
                                    <th>Заказчик</th>
                                    <th>Стоимость</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th>Действия</th>
                                </tr>

                            <!-- Запуск выводы данных по запросу -->
                            <?
                                while ($mas = mysqli_fetch_array($result)){
                            ?>

                                <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">	
                                    <td><? echo $mas['id_order'];?></td>
                                    <td><? echo $mas['name_detail'] ," x ", $mas['kol_details_order'];?> шт.</td>
                                    <td><? echo $mas['capacity_order'];?> м3</td>
                                    <td><? echo $mas['name_costumer'];?></td>
                                    <td><? echo $mas['cost_order'];?> ₽</td>
                                    <td><? echo $mas['name_status'];?></td>
                                    <td><? echo $mas['date_order'];?></td>

                                    <td style="height: 4em; display: flex; flex-direction: row; align-items: center;">
                                        <!-- Кнопка "Удалить заказ" -->
                                        <form method="post" action="../../../static/php/remove_order.php" target="_self" onsubmit="return confirm('Выбранный заказ будет безвозвратно удалён. Выполнить действие?');">
                                            <button type="submit" name="id" value="<?=$mas['id_order'];?>">
                                                <img src="../assets/images/delete.png" title="Удалить заказ" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>  
                
                                        <!-- Кнопка Отменить заказ -->
                                        <form method="post" action="../../../static/php/cancel_order.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_order'];?>">
                                                <img src="../assets/images/cancel.png"  title="Отменить заказ" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>

                                        <!-- Кнопка "Получить на склад заказ" -->
                                        <form method="post" action="../../../static/php/storage_order.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_order'];?>">
                                                <img src="../assets/images/storage.png" title="Принять на склад" style="width: 20px; height: 20px; margin-right: 10px;">
                                            </button> 
                                        </form>

                                        <!-- Кнопка "Выполнить заказ" -->
                                        <form method="post" action="../../../static/php/complete_order.php" target="_self">
                                            <button type="submit" name="id" value="<?=$mas['id_order'];?>">
                                                <img src="../assets/images/complete.png" title="Выполнить заказ" style="width: 20px; height: 20px;">
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
