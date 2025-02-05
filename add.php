<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $task = $_POST['task'];
    $conn->query("INSERT INTO tasks (user_id, task) VALUES ('$user_id', '$task')");
}
ob_start();
header("Location: index.php");
exit();
?>
