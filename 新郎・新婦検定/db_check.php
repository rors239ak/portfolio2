<?php
require 'db.php';
// ← 先頭に空白や改行ナシ！
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['start_time'])) {
  header('Location: index.php'); exit;
}




// 【仮】終了時刻いまこの瞬間（本番は end.php から渡す）
$end = microtime(true);
$elapsed = $end - $_SESSION['start_time'];

// mm:ss.mmm に整形
$min = (int)floor($elapsed / 60);
$sec = $elapsed - ($min * 60);
$disp = sprintf('%02d:%06.3f', $min, $sec);



$count = 0;
if($_SESSION["question1"] == "ボードゲームカフェ"){$count += 1;}
if($_SESSION["question2"] == "歯"){$count += 1;}
if($_SESSION["question3"] == "無視"){$count += 1;}
if($_SESSION["question4"] == "にゃんちゅう"){$count += 1;}
if($_SESSION["question5"] == "ひまわり"){$count += 1;}
if($_SESSION["question6"] == "焼肉屋"){$count += 1;}
if($_SESSION["question7"] == "結婚して？"){$count += 1;}
if($_SESSION["question8"] == "アイス"){$count += 1;}
if($_SESSION["question9"] == "King & Prince"){$count += 1;}
if($_SESSION["question10"] == "アクアリウム"){$count += 1;}
if($_SESSION["question11"] == "大阪"){$count += 1;}
if($_SESSION["question12"] == "春巻き"){$count += 1;}

$total = ($count / $_SESSION["question_count"] * 100);

// 経過秒数（float値）
$elapsed = (float)$_SESSION['elapsed_s'];

// 経過時間を mm:ss.mmm に整形
$min = (int)floor($elapsed / 60);
$sec = $elapsed - ($min * 60);
$disp = sprintf('%02d:%06.3f', $min, $sec);

// 🔽 追加：5秒ごとに1ポイント加算
$bonus = floor($elapsed / 5);  

$last_total = 0;
//50秒以内なら減点なし
$last_total = $total - $bonus + 10;
// 100を超えないようにする
$last_total = round(min($last_total, 100));
$last_total = round(max($last_total, 0));






// 名前と点数を取得（例：セッションやPOSTで）
$name  = $_SESSION['name'] ?? '名無し'; 
$score = $last_total; 

// 今の時刻を取得
$submitted_at = date('H:i:s');

// データベースに保存
$stmt = $pdo->prepare("INSERT INTO results (name, score, submitted_at) VALUES (:name, :score, :submitted_at)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':score', $score);
$stmt->bindParam(':submitted_at', $submitted_at);
$stmt->execute();

// 保存完了したら別のページに飛ばす
header("Location: result.php");
exit;

?>

