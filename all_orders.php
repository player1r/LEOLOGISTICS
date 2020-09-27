<?php
    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Запрос на вывод данных
    $result = $mysql->query("SELECT * FROM `orders`");

?>
    <a href="/static/html/admin_panel_orders.php">Назад</a>
    <table width="100%">
        <tr>
            <th height="30px">ID заказа</th>
            <th>ID детали</th>
            <th>Количество деталей, шт</th>
            <th>ID склада</th>
            <th>Размер заказа, м3</th>
            <th>ID заказчика</th>
            <th>ID пользователя</th>
            <th>Дата создания</th>
            <th>Статус</th>
            <th>Стоимость, руб.</th>
            <th>Дата завершения</th>
        </tr>

        <!-- Запуск выводы данных по запросу -->
        <?
            while ($mas = mysqli_fetch_array($result)){
        ?>

            <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">	
                <td><? echo $mas['id_order'];?></td>
                <td><? echo $mas['id_detail'];?></td>
                <td><? echo $mas['kol_details_order'];?></td>  
                <td><? echo $mas['id_storage'];?></td>              
                <td><? echo $mas['capacity_order'];?></td>
                <td><? echo $mas['id_costumer'];?></td>              
                <td><? echo $mas['id_user'];?></td>
                <td><? echo $mas['date_order'];?></td>
                <td><? echo $mas['status_order'];?></td>
                <td><? echo $mas['cost_order'];?></td>
                <td><? echo $mas['date_success_order'];?></td>                
            </tr>
            
    <!-- Конец PHP -->
    <? }?>
    </table>

    <? $mysql->close(); ?>