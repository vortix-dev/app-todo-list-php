<?php
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    ob_start();
    header("Location: seconnecter.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM tasks WHERE user_id = $user_id");

$task_to_edit = "";
$task_id = "";
if (isset($_GET['edit'])) {
    $task_id = $_GET['edit'];
    $edit_query = $conn->query("SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id");
    if ($edit_query->num_rows > 0) {
        $task_to_edit = $edit_query->fetch_assoc()['task'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center bg-primary text-white">
            <h2>📌 Votre To-Do List</h2>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="text-primary">Bienvenue, Utilisateur</h5>
                <a href="deconnecter.php" class="btn btn-danger btn-sm">Déconnexion</a>
            </div>

            <!-- Formulaire d'ajout/modification de tâche -->
            <form action="<?= isset($_GET['edit']) ? 'edit.php' : 'add.php' ?>" method="POST" class="d-flex">
                <input type="hidden" name="task_id" value="<?= $task_id ?>">
                <input type="text" name="task" class="form-control" value="<?= htmlspecialchars($task_to_edit) ?>" placeholder="Ajouter ou modifier une tâche..." required>
                <button type="submit" class="btn btn-<?= isset($_GET['edit']) ? 'warning' : 'success' ?> ms-2">
                    <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
                </button>
            </form>

            <ul class="list-group mt-4">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($row['task']); ?>
                        <div>
                            <a href="index.php?edit=<?= $row['id']; ?>" class="btn btn-white btn-sm">✏️</a>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-white btn-sm">❌</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
