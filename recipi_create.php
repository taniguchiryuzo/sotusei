<?php

// var_dump($_POST);
// exit();

// POSTデータ確認

// todo_create.php

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

// todo_create.php

$title = $_POST['title'];
$Introduction = $_POST['Introduction'];
$material = $_POST['material'];
$how = $_POST['how'];


// DB接続
// todo_create.php

// 各種項目設定
$dbn = 'mysql:dbname=sotusei;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．


// todo_create.php

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
