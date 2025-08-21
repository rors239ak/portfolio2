<?php
$dsn = 'mysql:host=localhost;dbname=example;charset=utf8';//dbnameは使用するデータベース名を入力
$user = 'root';   
$pass = 'example';//自分のデータベースのパスワード

try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
  exit;
}
