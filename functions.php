<?php
// データベースに接続
function connectDB()
{
    $param = 'mysql:dbname=my;host=localhost';
    try {
        $pdo = new PDO($param, 'root', '');
        return $pdo;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
