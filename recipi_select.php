<?php

// DB接続
require_once 'recipi_function.php';
$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  // 画像を取得
  // SQL作成&実行
  $sql = 'SELECT * FROM recipi_image ORDER BY created_at ASC';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $recipi_image = $stmt->fetchAll();
}
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
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 border-right">
        <ul class="list-unstyled">
          <?php for ($i = 0; $i < count($recipi_image); $i++) : ?>
            <li class="media mt-5">
              <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                <img src="recipi_image.php?id=<?= $recipi_image[$i]['image_id']; ?>" width="200" height="auto" class="mr-3">
              </a>
              <div class="media-body">
                <h5><?= $recipi_image[$i]['image_name']; ?> (<?= number_format($recipi_image[$i]['image_size'] / 1000, 2); ?> KB)</h5>
                <a href="javascript:void(0);" onclick="var ok = confirm('削除しますか？'); if (ok) location.href='recipi_delete.php?id=<?= $recipi_image[$i]['image_id']; ?>'">
                  <i class="far fa-trash-alt"></i> 削除</a>
              </div>
            </li>
          <?php endfor; ?>
        </ul>
      </div>
    </div>
  </div>

  <div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel" style="position:fixed;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($recipi_image); $i++) : ?>
              <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
          </ol>

          <div class="carousel-inner">
            <?php for ($i = 0; $i < count($recipi_image); $i++) : ?>
              <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                <img src="recipi_image.php?id=<?= $recipi_image[$i]['image_id']; ?>" class="d-block w-100">
              </div>
            <?php endfor; ?>
          </div>

          <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>