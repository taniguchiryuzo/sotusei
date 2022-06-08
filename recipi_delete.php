<?php
require_once 'recipi_function.php';

$pdo = connectDB();

$sql = 'DELETE FROM recipi_image WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();

header('Location:recipi_select.php');
exit();
