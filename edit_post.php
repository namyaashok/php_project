<?php
include 'db.php';

$id = $_GET['id'];

// Fetch existing post
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();

if(isset($_POST['update']))
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

    // Update only if validation passes
    if(empty($errors))
    {
        $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $id);

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
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="edit-container">

    <h1>Edit Post</h1>

    <form method="POST">

        <label>Title</label>
        <input type="text" 
               name="title"
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