<?php
mb_internal_encoding('UTF-8');
$pageTitle = "Съобщения";
include 'includes/header.php';
if($_SESSION){
            $sql_show = "SELECT * FROM `users`.`user_posts`
            ORDER BY date_registered DESC;";//sql заявка, подредба по дата, най новите отгоре!
        $a = mysqli_query($connect, $sql_show);
        if(!$a){
            echo "Грешка при обработка на данните!";
            header( "refresh:2" );
        //echo mysqli_error($connect);
        }
        if($a->num_rows>0){ //Показване на съобщенията!
        echo '<table class="titles posts"><tr><th>Съобщения</th></tr>';
        while ($row = $a->fetch_assoc()) {
        echo '<tr><td>'.$row['date_registered'].'/<b>'.$row['user_name'].'</b></td></tr>';//Дата и име!
        echo '<tr><td>'.$row['head'].'</td></tr>';//Заглавие
        echo '<td><h4>'.$row['post'].'</h4></td>';//Съдържание
            }
        }
            else {
             echo 'Няма съобщения!';}
        echo '</tr>';

include 'includes/footer.php';

 } else {echo 'Вие не сте логнат!';
     header( "refresh:1;url=index.php") ;} ?>
