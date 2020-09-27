<?php
    include 'config.php';

    //Подключение к БД
    $mysql = new mysqli($host,$user,$passw,$db);

    //Запрос на вывод данных
    $result = $mysql->query("SELECT * FROM `details`");

?>
    <a href="/static/html/admin_panel_details.php">Назад</a>
    <table width="100%">
        <tr>
            <th height="30px">ID</th>
            <th>Название</th>
            <th>Размер, м3</th>
            <th>ID производителя</th>
            <th>Стоимость, руб.</th>
        </tr>

        <!-- Запуск выводы данных по запросу -->
        <?
            while ($mas = mysqli_fetch_array($result)){
        ?>

            <tr onmouseover="this.style.background='rgba(0, 168, 247, 0.1)';" onmouseout="this.style.background='white';">
                <td><? echo $mas['id_detail'];?></td>
                <td><? echo $mas['name_detail'];?></td>              
                <td><? echo $mas['size_detail'];?></td>
                <td><? echo $mas['id_provider'];?></td>      
                <td><? echo $mas['cost_detail'];?></td>            
            </tr>
            
    <!-- Конец PHP -->
    <? }?>
    </table>

    <? $mysql->close(); ?>