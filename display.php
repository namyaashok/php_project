<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<?php
include 'config.php';

$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo "<h3>".$row['title']."</h3>";
    echo "<p>".$row['content']."</p>";

    echo "<a href='edit_post.php?id=".$row['id']."'>Edit</a> | ";

    echo "<a href='delete_post.php?id=".$row['id']."'>Delete</a>";

    echo "<hr>";
}
?>