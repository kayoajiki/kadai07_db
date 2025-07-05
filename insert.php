<?php
include('db.php');

$name = $_POST['name'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$status = $_POST['status'];
$comment = $_POST['comment'];

$sql = "INSERT INTO tb (name, lat, lng, status, comment) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $lat, $lng, $status, $comment]);

echo json_encode(['success' => true]);
