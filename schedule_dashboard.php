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

// セッションの開始
session_start();

// ユーザー名の取得
$name = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// 予約ボタンが押された場合の処理
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["class_id"])) {
    $class_id = $_POST["class_id"];

    // ユーザー名が取得できている場合のみ予約処理を実行
    if ($name !== '') {
        // 予約をデータベースに追加するクエリを実行
        $reservation_date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO Reservations (name, class_id, reservation_date) VALUES ('$name', '$class_id', '$reservation_date')";
        if ($conn->query($sql) === TRUE) {
            echo "Reservation for class ID: $class_id was successful.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // ユーザー名が取得できない場合はエラーメッセージを表示
        echo "Error: User is not logged in.";
    }
}

// 予約可能なクラスを取得するクエリを実行
$sql = "SELECT class_id, class_name, class_datetime, class_location FROM Classes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 予約可能なクラスがある場合、それぞれをリスト表示する
    while ($row = $result->fetch_assoc()) {
        // 各クラスの残り空き人数を取得するクエリを実行する
        $class_id = $row['class_id'];
        $reservation_count_sql = "SELECT COUNT(*) AS reservation_count FROM Reservations WHERE class_id = $class_id";
        $reservation_count_result = $conn->query($reservation_count_sql);
        $reservation_count_row = $reservation_count_result->fetch_assoc();
        $available_seats = 3 - $reservation_count_row['reservation_count'];

        // 残り空き人数が1以上の場合にのみ表示する
        if ($available_seats > 0) {
            echo "<li>";
            echo "<p>Class Name: " . $row['class_name'] . "</p>";
            echo "<p>Date and Time: " . $row['class_datetime'] . "</p>";
            echo "<p>Location: " . $row['class_location'] . "</p>";
            echo "<p>Available Seats: " . $available_seats . "</p>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='class_id' value='" . $row['class_id'] . "'>";
            echo "<button type='submit'>Reserve</button>";
            echo "</form>";
            echo "</li>";
        }
    }
} else {
    echo "No available classes.";
}

// データベースからの切断
$conn->close();
?>
