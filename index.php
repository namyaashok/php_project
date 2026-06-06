<?php
session_start();

echo "Welcome "
     .$_SESSION['user'];

echo "<br><a href='logout.php'>Logout</a>";
?>