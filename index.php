<?php
include 'db.php';

if(isset($_GET['search'])) {

    $search = $_GET['search'];

    $sql = "SELECT * FROM posts WHERE title LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='post'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
    }

} else {

    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='post'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
    }
}
?>