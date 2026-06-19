<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>BLOG POSTS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="GET">
    <input type="text" name="search" placeholder="Enter title">
    <button type="submit">Search</button>
</form>

<?php

include 'db.php';

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

if(isset($_GET['search']) && $_GET['search'] != '')
{
    $search = "%" . $_GET['search'] . "%";

    // Fetch posts
    $stmt = $conn->prepare(
        "SELECT * FROM posts
         WHERE title LIKE ?
         LIMIT ?, ?"
    );

    $stmt->bind_param("sii", $search, $start, $limit);
    $stmt->execute();

    $result = $stmt->get_result();


    // Count total posts
    $count_stmt = $conn->prepare(
        "SELECT COUNT(*) AS total
         FROM posts
         WHERE title LIKE ?"
    );

    $count_stmt->bind_param("s", $search);
    $count_stmt->execute();

    $count_result = $count_stmt->get_result();
    $count_row = $count_result->fetch_assoc();
}
else
{
    $search = '';

    $sql = "SELECT * FROM posts
            LIMIT $start, $limit";

    $count_query = "SELECT COUNT(*) AS total
                    FROM posts";
}

if(!isset($_GET['search']) || $_GET['search'] == '')
{
    $result = mysqli_query($conn, $sql);

    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
}

echo "<div class='container'>";
echo "<h1>BLOG POSTS</h1>";
echo "<a href='add_post.php' class='add-btn'>+ Add New Post</a>";
echo "<table border='1'>";
echo "<tr>
        <th>Sl No</th>
        <th>Title</th>
        <th>Content</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>";

$sl = $start + 1;

while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>";
    echo "<td>".$sl++."</td>";
    echo "<td>".$row['title']."</td>";
    echo "<td>".$row['content']."</td>";
    echo "<td><a class='edit-btn' href='edit_post.php?id=".$row['id']."'>Edit</a></td>";
    if($_SESSION['role'] == 'admin')
{
    echo "<td><a class='delete-btn' href='delete_post.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this post?\")'>Delete</a></td>";
}
else
{
    echo "<td>Not Allowed</td>";
}
}

echo "</table>";

$total_posts = $count_row['total'];
$total_pages = ceil($total_posts / $limit);

echo "<div class='pagination'>";

for($i = 1; $i <= $total_pages; $i++)
{
    echo "<a href='display.php?page=$i&search=$search'>$i</a> ";
}

echo "</div>";
echo "</div>";

?>
</body>
</html>