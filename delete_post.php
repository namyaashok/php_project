<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM posts
        WHERE id=$id";

mysqli_query($conn,$sql);

header("Location:index.php");
?>