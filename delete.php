<?php

require_once 'db.php';

if (!isset($_POST['id'])) {
    echo 'Missing parameters';
    exit;
}

$id = $_POST['id'];

$sql = 'DELETE FROM tasks WHERE id = :id';

$statement = $pdo->prepare($sql);
$statement->execute([
    ':id' => $id
]);

echo 'Task deleted';
