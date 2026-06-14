<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn,
    "INSERT INTO posts(title, content)
     VALUES('$title', '$content')");

    header("Location: display.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="edit-container">

    <h1>Add New Post</h1>

    <form method="POST">

        <label>Title</label>
        <input type="text" name="title" required>

        <label>Content</label>
        <textarea name="content" required></textarea>

        <button type="submit" name="submit">
            Add Post
        </button>

    </form>

</div>

</body>
</html>