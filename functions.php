<?php
require 'db.php';

// Отримання всіх категорій
function getCategories($pdo) {
    $stmt = $pdo->query('SELECT * FROM categories');
    return $stmt->fetchAll();
}

// Додавання справи
function addTask($pdo, $title, $description, $category_id) {
    $stmt = $pdo->prepare('INSERT INTO tasks (title, description, category_id) VALUES (?, ?, ?)');
    return $stmt->execute([$title, $description, $category_id]);
}

// Отримання всіх справ
function getTasks($pdo) {
    $stmt = $pdo->query('SELECT tasks.*, categories.name AS category FROM tasks LEFT JOIN categories ON tasks.category_id = categories.id');
    return $stmt->fetchAll();
}

// Оновлення справи
function updateTask($pdo, $id, $title, $description, $category_id) {
    $stmt = $pdo->prepare('UPDATE tasks SET title = ?, description = ?, category_id = ? WHERE id = ?');
    return $stmt->execute([$title, $description, $category_id, $id]);
}

// Видалення справи
function deleteTask($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
    return $stmt->execute([$id]);
}
?>
