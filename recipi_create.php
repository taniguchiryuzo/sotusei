<?php

session_start();
include('recipi_function.php');
check_session_id();

require_once('recipi_function.php');

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得


    // $sql = 'SELECT * FROM recipi_image ORDER BY created_at DESC';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // $recipi_image = $stmt->fetchAll();
} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];

        $sql = 'INSERT INTO recipi_image(image_name, image_type, image_content, image_size, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();
    }
    header('Location:recipi_input.php');
    // exit();
}

// var_dump($_POST);
// exit();

// POSTデータ確認

// ー－フォーム入力内容の保存ー－

if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['Introduction']) || $_POST['Introduction'] == '' ||
    !isset($_POST['material']) || $_POST['material'] == '' ||
    !isset($_POST['how']) || $_POST['how'] == ''
) {
    exit('データが足りません');
}


// if (
//     !isset($_POST['todo']) || $_POST['todo'] == '' ||
//     !isset($_POST['deadline']) || $_POST['deadline'] == ''
// ) {
//     exit('データが足りません');
// }



$title = $_POST['title'];
$Introduction = $_POST['Introduction'];
$material = $_POST['material'];
$how = $_POST['how'];



// SQL作成&実行
$sql = 'INSERT INTO recipi_test (id, title, Introduction, material, how, created_at, updated_at) 
VALUES (NULL,:title,:Introduction,:material,:how, now(), now())
';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':Introduction', $Introduction, PDO::PARAM_STR);
$stmt->bindValue(':material', $material, PDO::PARAM_STR);
$stmt->bindValue(':how', $how, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}




header('Location:recipi_input.php');
exit();
