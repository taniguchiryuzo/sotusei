<?php
// データベースに接続
function connectDB()
{
    $param = 'mysql:dbname=sotusei;charset=utf8mb4;port=3306;host=localhost';
    try {
        $pdo = new PDO($param, 'root', '');
        return $pdo;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
// ログイン状態のチェック関数
function check_session_id()
{
    if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] != session_id()) {
        // not login
        header("location:recipi_login.php");
    } else {
        // login
        session_regenerate_id(true);
        $_SESSION["session_id"] = session_id();
    }
}
