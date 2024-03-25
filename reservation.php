<?php
// データベース接続
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gym_schedule";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

// POST リクエストからクラスの ID を取得
if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];

    // ユーザーがクラスを予約する処理を実行する
    // 例えば、Reservations テーブルに新しい予約を挿入するなどの処理を行います
    // ここではサンプルとして、Reservations テーブルに新しい予約を挿入する処理を示します
    $user_id = 1; // 仮のユーザー ID、実際にはログインユーザーの ID を使用する必要があります
    $reservation_date = date("Y-m-d H:i:s"); // 予約日時を取得
    $sql = "INSERT INTO Reservations (user_id, class_id, reservation_date) VALUES ('$user_id', '$class_id', '$reservation_date')";
    if ($conn->query($sql) === TRUE) {
        // 予約が成功した場合のメッセージを表示する
        echo "Reservation for class ID: $class_id was successful.";
    } else {
        // 予約が失敗した場合のエラーメッセージを表示する
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // クラスの ID が POST リクエストで提供されなかった場合のエラーメッセージ
    echo "Class ID was not provided.";
}

// データベースからの切断
$conn->close();
?>
