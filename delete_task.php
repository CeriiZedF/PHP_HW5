<?php
require 'db.php';
require 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteTask($pdo, $id)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Помилка при видаленні справи.";
    }
}
?>
