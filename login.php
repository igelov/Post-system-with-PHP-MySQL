<?php
mb_internal_encoding('UTF-8');
if(!$_SESSION){
if($_POST){
    $name=trim($_POST['name']);
    $pass=$_POST['pass'];
    $error=false;
    $count= 0;
    if(mb_strlen($name)< 5 && mb_strlen($name)> 50 ){
        $error=true;
    }
    if (strlen($pass)< 5 && strlen($pass)> 50) {
        $error=true;
    }
    if(!$error){
        $sql="SELECT * FROM `users`.`user_data` WHERE `username`='".$name."' and `password`='".$pass."'";
        $result = @mysqli_query($connect, $sql);
        $count= @mysqli_num_rows($result);
      if($count==1){ //Проверка за сходни данни.
            $_SESSION['isLogged']=true;
            $_SESSION['user']=$name;
            echo "<h3>Влезнахте успешно!</h3>";
            header( "refresh:1;url=posts.php" );
            exit;
            }
            else{
                echo 'Неправилно име или парола!';
            }
    }
    else{
        echo "<h3>Грешни данни!</h3>";
        echo $error;
    }
    }
?>
<form id='login' method="POST">
    <div>Име:<input type="text" name="name" /></div>
    <div>Парола:<input type="password" name="pass" /></div>
    <div><input type="submit" value="Влез" /></div>
</form>
<?php } else {echo '<h3>Вие вече сте логнат!<h3>';
    header( "refresh:1;url=posts.php" );
        exit;} ?>
