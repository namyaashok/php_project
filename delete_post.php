
<?php
session_start();

if($_SESSION['role'] != 'admin')
{
    die("Access Denied");
}
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->close();

header("Location:index.php");
?>