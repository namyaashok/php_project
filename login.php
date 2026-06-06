<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE username='$username'";

    $result = mysqli_query($conn,$sql);

    $user = mysqli_fetch_assoc($result);

    if($user &&
       password_verify(
           $password,
           $user['password']
       )){

        $_SESSION['user']=$username;

        header("Location:index.php");

    }else{

        echo "Invalid Login";

    }
}
?>

<form method="POST">

Username:
<input type="text" name="username"><br><br>

Password:
<input type="password" name="password"><br><br>

<input type="submit"
name="login"
value="Login">

</form>