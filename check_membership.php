<?php
// PHPMyAdminのデータベース接続情報
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "会員登録";

// POSTリクエストから会員番号を取得
$memberNumber = $_POST['memberNumber'];

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続を確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// データベースクエリを作成して実行
$sql = "SELECT * FROM reservations WHERE member_number='$memberNumber'";
$result = $conn->query($sql);

// クエリの結果をチェックして適切なレスポンスを返す
if ($result->num_rows > 0) {
    // 会員番号がデータベース内に存在する場合
    echo "valid";
} else {
    // 会員番号がデータベース内に存在しない場合
    echo "invalid";
}

// データベース接続を閉じる
$conn->close();
?>
