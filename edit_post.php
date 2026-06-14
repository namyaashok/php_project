<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn,
    "UPDATE posts
     SET title='$title', 
         content='$content'
     WHERE id=$id");

    header("Location: display.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="edit-container">

    <h1>Edit Post</h1>

    <form method="POST">

        <label>Title</label>
        <input type="text" name="title"
               value="<?php echo $row['title']; ?>">

        <label>Content</label>
        <textarea name="content"><?php echo $row['content']; ?></textarea>

        <button type="submit" name="update">
            Update Post
        </button>

    </form>

</div>

</body>
</html>