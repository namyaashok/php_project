<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $errors = [];

    // Validation
    if(empty($title))
    {
        $errors[] = "Title is required";
    }

    if(empty($content))
    {
        $errors[] = "Content is required";
    }

    if(strlen($title) > 100)
    {
        $errors[] = "Title should not exceed 100 characters";
    }

    // Insert only if there are no errors
    if(empty($errors))
    {
        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");

        $stmt->bind_param("ss", $title, $content);

        $stmt->execute();

        $stmt->close();

        header("Location: display.php");
        exit();
    }
    else
    {
        foreach($errors as $error)
        {
            echo "<p style='color:red;'>$error</p>";
        }
    }
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
        <input type="text"
               name="title" 
               required
               maxlength="100">

        <label>Content</label>
        <textarea name="content" 
                  required></textarea>

        <button type="submit" name="submit">
            Add Post
        </button>

    </form>

</div>

</body>
</html>