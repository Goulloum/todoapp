<?php

require_once 'db.php';

if (!isset($_POST['title']) || !isset($_POST['description'])) {
    echo 'Missing parameters';
    exit;
}

$title = $_POST['title'];
$description = $_POST['description'];

$sql = 'INSERT INTO tasks (title, description, status) VALUES (:title, :description, 0)';

$statement = $pdo->prepare($sql);
$statement->execute([
    ':title' => $title,
    ':description' => $description
]);

echo 'Task added';
