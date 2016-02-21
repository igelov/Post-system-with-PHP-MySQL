<?php
mb_internal_encoding('UTF-8');
$pageTitle = "Ново съобщение";
include 'includes/header.php';
if($_SESSION){
   if($_POST){
    $head=trim($_POST['head']);
    $post=$_POST['post'];
    $error=false;
    if(mb_strlen($head)< 1 || strlen($head) > 50){
        echo '<p>Името е прекалено късо или прекалено дълго.<br> Минимум знаци - 1!</p>';
        $error=true;
    } //Проверка за заглавие
    if (strlen($post)< 1 || strlen($post) > 250) {;
      echo '<p>Невалидно съдържание!<br>
          Съдържанието трябва да е от 1 до 250 символа!</p>';
        $error=true;// проверка за съдържание
    }
    if(!$error){
        $name_post = $_SESSION['user'];
        $sql = "INSERT INTO `users`.`user_posts`
            (`head`, `post`,`user_name`) VALUES ('$head', '$post', '$name_post');";
        $a = @mysqli_query($connect, $sql);
        if(!$a){
            echo "Грешка при регистриране!";
            header( "refresh:2" );
        //echo mysqli_error($connect);
        }
       elseif($a){
           echo 'Съобщението изпратено успешно!';
           header( "refresh:1;url=posts.php" );
       }
    }

}
  include 'includes/footer.php';
?>
<table  class="titles">
    <tr>
        <th>Ново съобщение</th>
    </tr>
    <td>
     <form class="menu" method="POST">
    <div>Заглавие:<input type="text" name="head" /></div>
    <div>Съдържание:<textarea name="post"></textarea></div>
   <div><input type="submit" value="Добави" /></div>
</form></td>
</table>
<?php

     } else {echo 'Вие не сте логнат!';
     header( "refresh:1;url=index.php") ;} ?>
