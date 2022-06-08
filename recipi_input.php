<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レシピの作成</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <form action="recipi_create.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>レシピの作成</legend>
      <a href="recipi_select.php">一覧画面</a>
      <div>
        料理名: <input type="text" name="title">
      </div>
      <div>
        料理の紹介: <input type="text" name="Introduction">
      </div>
      <div>
        材料: <input type="text" name="material">
      </div>
      <div>
        作り方: <input type="text" name="how">
      </div>
      <div>
        <label>写真</label> : <input type="file" name="image">
      </div>
      <div>
        <button type="submit">レシピの登録</button>
      </div>
    </fieldset>
  </form>

</body>

</html>