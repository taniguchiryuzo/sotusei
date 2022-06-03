<?php
require_once 'functions.php';

$pdo = connectDB();

$sql = 'SELECT * FROM images WHERE imageid = :imageid LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':imageid', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type: ' . $image['image_type']);
echo $image['image_content'];
exit();
