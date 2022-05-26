<?php

// DB接続
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



// SQL作成&実行
// todo_read.php

$sql = 'SELECT title, Introduction,material,how FROM recipi_test ORDER BY title ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

  $output = "";
  foreach ($result as $record) {
    $output .= "
    <tr>
      <td>{$record["title"]}</td>
      <td>{$record["Introduction"]}</td>
      <td>{$record["material"]}</td>
      <td>{$record["how"]}</td>
    </tr>
  ";
    echo '<script>console.log(' . json_encode($output) . ');</script>';
  }
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}






?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レシピ集</title>
</head>

<body>
  <fieldset>
    <legend>レシピ集）</legend>
    <a href="recipi_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>料理名</th>
          <th>料理の紹介</th>
          <th>材料</th>
          <th>作り方</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>


</body>

</html>