<?php
session_start();

// データベース接続
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tatsus_gym_users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

// フォームからのデータを取得
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['User_password']) && isset($_POST['creditCard'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['User_password'];
    $creditCard = $_POST['creditCard'];

    // データベースの更新処理
    $sql = "UPDATE users SET email='$email', User_password='$password', credit_card='$creditCard' WHERE name='$name'";
    if ($conn->query($sql) === TRUE) {
      sleep(2);
      header("Location: login.html");
exit; // 必要に応じてスクリプトの実行を終了します
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// データベースからの切断
$conn->close();
?>
