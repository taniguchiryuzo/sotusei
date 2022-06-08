<?php
require_once 'recipi_function.php';

$pdo = connectDB();

$sql = 'SELECT * FROM recipi_image WHERE image_id = :image_id LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type: ' . $image['image_type']);
echo $image['image_content'];
exit();
