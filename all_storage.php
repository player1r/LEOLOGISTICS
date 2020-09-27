<?php
    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Запрос на вывод данных
    $result = $mysql->query("SELECT * FROM `storage`");

?>
    <a href="/static/html/admin_panel_storage.php">Назад</a>
    <table width="100%">
        <tr>
            <th height="30px">ID</th>
            <th>Название</th>
            <th>Физический объём, м3</th>
            <th>Свободный объём, м3</th>
            <th>Адрес</th>
            <th>Статус</th>
        </tr>

        <!-- Запуск выводы данных по запросу -->
        <?
            while ($mas = mysqli_fetch_array($result)){
        ?>

            <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">
                <td><? echo $mas['id_storage'];?></td>
                <td><? echo $mas['name_storage'];?></td>              
                <td><? echo $mas['capacity_storage'];?></td>
                <td><? echo $mas['free_capacity_storage'];?></td>      
                <td><? echo $mas['address_storage'];?></td>    
                <td><? echo $mas['active_storage'];?></td>                   
            </tr>
            
    <!-- Конец PHP -->
    <? }?>
    </table>

    <? $mysql->close(); ?>