<?php
// like_create.php

// var_dump($_GET);
// exit();


include('recipi_function.php');

$user_id = $_GET['user_id'];
$recipi_id = $_GET['recipi_id'];

$pdo = connectDB();

$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND recipi_id=:recipi_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':recipi_id', $recipi_id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$like_count = $stmt->fetchColumn();
// まずはデータ確認
// var_dump($like_count);
// exit();

if ($like_count != 0) {
    // いいねされている状態
    $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND recipi_id=:recipi_id';
} else {
    // いいねされていない状態
    $sql = 'INSERT INTO like_table (id, user_id, recipi_id, created_at) VALUES (NULL, :user_id, :recipi_id, sysdate())';
}
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':recipi_id', $recipi_id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:recipi_select.php");
exit();

$sql = 'INSERT INTO like_table (id, user_id, recipi_id, created_at) VALUES (NULL, :user_id, :recipi_id, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':recipi_id', $recipi_id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:recipi_select.php");
exit();
