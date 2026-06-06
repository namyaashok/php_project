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

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts
            SET title='$title',
                content='$content'
            WHERE id=$id";

    mysqli_query($conn,$sql);

    header("Location:index.php");
}

$sql = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<form method="POST">

Title:
<input type="text" name="title"
value="<?php echo $row['title']; ?>"><br><br>

Content:
<textarea name="content"><?php echo $row['content']; ?></textarea><br><br>

<input type="submit"
name="update"
value="Update">

</form>