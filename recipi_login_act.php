<?php
// データ受け取り
session_start();
include("recipi_function.php");


$username = $_POST['username'];
$password = $_POST['password'];
// DB接続
$pdo = connectDB();
// SQL実行
$sql = 'SELECT * FROM users_table WHERE username = :username AND password = :password AND is_admin=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}


// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
    // NG
    echo "<p>ログイン情報に誤りがあります</p>";
    echo "<a href=login.html>ログイン</a>";
    exit();
} else {
    // OK
    $_SESSION = array();
    $_SESSION['user_id'] = $val['id'];
    $_SESSION['session_id'] = session_id();
    $_SESSION['is_admin'] = $val['is_admin'];
    $_SESSION['username'] = $val['username'];
    header("Location:toppage.html");
    exit();
}
