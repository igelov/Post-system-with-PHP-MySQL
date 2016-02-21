<?php
mb_internal_encoding('UTF-8');
$pageTitle = "Регистрация";
include 'includes/header.php';
if(!$_SESSION){
   if($_POST){
    $name=trim($_POST['name']);
    $pass=$_POST['pass'];
    $error=false;
    $count=0;
    if(mb_strlen($name)< 5 || strlen($name) > 50){
        echo '<p>Името <b>невалидно</b>. Трябва да е от 5 до 50 символа!</p>';
        $error=true;
    }
    if (strlen($pass)< 5 || strlen($pass)> 50) {
      echo '<p><b>Невалидна</b> парола!<br>
          Паролата трябва да е от 5 до 50 символа!</p>';
        $error=true;
    }
      $sql="SELECT * FROM `users`.`user_data` WHERE `username`='".$name."'";
        $result = @mysqli_query($connect, $sql);
        $count=@mysqli_num_rows($result);
      if($count>0){echo "Има такъв потребител!";
      header( "refresh:2");
      $error=true;
      }
    if(!$error){
        $sql = "INSERT INTO `users`.`user_data`
            (`username`, `password`) VALUES ('$name', '$pass');";
        $a = @mysqli_query($connect, $sql);
        if(!$a){
            echo "Грешка при регистриране!";
            header( "refresh:2" );
        //echo mysqli_error($connect);
        }
       elseif($a){
           echo 'Успешна регистрация!';
            header( "refresh:1;url=index.php" );
            echo $error;
       }
    }
}
?>
<table  class="titles">
    <tr>
        <th>Регистрация</th>
    </tr>
    <td><form method="POST">
    <div>Име:<input type="text" name="name" /></div>
    <div>Парола:<input type="password" name="pass" /></div>
    <div><input type="submit" value="Добави потребител" /></div>
</form></td>
</table>

<?php
include 'includes/footer.php';
?>

<?php } else {echo 'Вие сте логнат!';
    echo '<a href="index.php">Назад</a>';} ?>
