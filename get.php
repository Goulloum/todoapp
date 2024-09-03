<?php

require_once 'db.php';

$sql = 'SELECT * FROM tasks';

$statement = $pdo->query($sql);
$todos = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($todos);
