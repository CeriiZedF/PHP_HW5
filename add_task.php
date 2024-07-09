<?php
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    if (addTask($pdo, $title, $description, $category_id)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Помилка при додаванні справи.";
    }
}
?>
