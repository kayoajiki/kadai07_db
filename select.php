<?php
include('db.php');

$sql = "SELECT * FROM tb";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();

echo json_encode($data);
