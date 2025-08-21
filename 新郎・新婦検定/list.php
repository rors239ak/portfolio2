<?php
require 'db.php';

$stmt = $pdo->query("SELECT name, score, submitted_at  FROM results ORDER BY score DESC");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>新郎・新婦検定</title>
</head>
  <header>
    <a href="index.php"><img src="image/image.png" alt="ロゴ" class="logo"></a> 
  </header>
  <body>
    <main>
      <h1>検定結果一覧</h1>
      <div class="center">
        <table border="1" cellpadding="8">
          <tr><th>名前</th><th>点数</th><th>送信時刻</th></tr>
          <?php foreach ($results as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['score']) ?></td>
              <td><?= htmlspecialchars($row['submitted_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </main>
    <footer>
      <a href="index.php"><img src="image/image.png" alt="ロゴ" class="logo"></a> 
    </footer>
  </body>
</html>