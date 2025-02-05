<?php
include 'connection.php';

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $conn->query("DELETE FROM tasks WHERE id = $id AND user_id = $user_id");
}
ob_start();

header("Location: index.php");
exit();
?>
