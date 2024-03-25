<?php

session_start(); // セッションを開始
// データベース接続の設定
$servername = "localhost";
$username = "root"; // データベースのユーザー名
$password = "root"; // データベースのパスワード
$dbname = "tatsus_gym_users"; // データベース名

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続を確認
if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

// フォームからのデータを受け取る
$name = $_POST['name'];
$User_password = $_POST['User_password'];

// ユーザーが存在するかどうかを確認するSQLクエリ
$sql = "SELECT * FROM users WHERE name='$name' AND User_password='$User_password'";

$result = $conn->query($sql);

// ユーザーが存在し、パスワードが一致する場合はログイン成功
if ($result->num_rows > 0) {
    // ログイン成功時の処理
    session_start(); // セッションを開始
    $_SESSION['username'] = $name; // ユーザー名をセッションに保存

    // ダッシュボードにリダイレクト
    header("Location: dashboard.php");
    exit(); // リダイレクト後にスクリプトの実行を停止するために必要
} else {
    // ログイン失敗時の処理
    echo "Login failed";
}

$conn->close();
?>
