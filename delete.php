<?php
require_once 'functions.php';

$pdo = connectDB();

$sql = 'DELETE FROM images WHERE imageid = :imageid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':imageid', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();

header('Location:list.php');
exit();
