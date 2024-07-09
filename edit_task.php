<?php
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    if (updateTask($pdo, $id, $title, $description, $category_id)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Помилка при редагуванні справи.";
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch();

        if (!$task) {
            echo "Справу з таким ID не знайдено.";
            exit;
        }
    } else {
        echo "ID справи не задано.";
        exit;
    }

    $categories = getCategories($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати справу</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Редагувати справу</h1>

    <form method="post" action="edit_task.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Назва справи</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категорія</label>
            <select class="form-select" id="category" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $task['category_id'] == $category['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Оновити справу</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
