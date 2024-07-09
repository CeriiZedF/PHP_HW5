<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список справ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Список справ</h1>

    <form id="task-form" method="post" action="add_task.php">
        <div class="mb-3">
            <label for="title" class="form-label">Назва справи</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категорія</label>
            <select class="form-select" id="category" name="category_id">
                <?php
                require 'db.php';
                require 'functions.php';
                $categories = getCategories($pdo);
                foreach ($categories as $category) {
                    echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Додати справу</button>
    </form>

    <h2 class="mt-5">Список справ</h2>
    <div id="task-list">
        <?php
        $tasks = getTasks($pdo);
        foreach ($tasks as $task) {
            echo "<div class=\"task-item mb-3\">
                    <h5>{$task['title']}</h5>
                    <p>{$task['description']}</p>
                    <small>Категорія: {$task['category']}</small>
                    <div>
                        <a href=\"edit_task.php?id={$task['id']}\" class=\"btn btn-warning btn-sm\">Редагувати</a>
                        <a href=\"delete_task.php?id={$task['id']}\" class=\"btn btn-danger btn-sm\">Видалити</a>
                    </div>
                </div>";
        }
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
