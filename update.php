<?php


require_once 'db.php';

if (!isset($_POST['status']) || !isset($_POST['id'])) {
    echo 'Missing parameters';
    exit;
}

$status = $_POST['status'];
$id = $_POST['id'];

$sql = 'UPDATE tasks SET status = :status WHERE id = :id';

$statement = $pdo->prepare($sql);
$statement->execute([
    ':status' => $status,
    ':id' => $id
]);

echo 'Task updated';
