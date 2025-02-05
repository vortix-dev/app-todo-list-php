<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id']) && isset($_POST['task'])) {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];

    // Vérifier si la tâche appartient bien à l'utilisateur
    $check_query = $conn->query("SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id");
    if ($check_query->num_rows > 0) {
        $conn->query("UPDATE tasks SET task = '$task' WHERE id = $task_id AND user_id = $user_id");
    }
}

header("Location: index.php");
exit();
