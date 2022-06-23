<?php

session_start();
include('recipi_function.php');
check_session_id();

require_once 'recipi_function.php';


$pdo = connectDB();

$sql = 'DELETE FROM recipi_image WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$sql = 'DELETE FROM recipi_test WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();

header('Location:recipi_select.php');
exit();
