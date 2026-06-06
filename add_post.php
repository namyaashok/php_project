<link rel="stylesheet" href="style.css">
<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<?php
include 'config.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts(title, content)
            VALUES('$title', '$content')";

    mysqli_query($conn, $sql);
}
?>

<form method="POST">
    Title:
    <input type="text" name="title"><br><br>

    Content:
    <textarea name="content"></textarea><br><br>

    <input type="submit" name="submit" value="Add Post">
</form>