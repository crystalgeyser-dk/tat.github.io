<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを受け取る
    $name = $_POST['name'];
    $email = $_POST['email'];
    $User_password = $_POST['User_password'];
    $creditCard = $_POST['creditCard'];

    // データベースへの接続
    $servername = "localhost"; // データベースのホスト名
    $username = "root"; // データベースのユーザー名
    $password = "root"; // データベースのパスワード
    $dbname = "tatsus_gym_users"; // 作成したデータベースの名前

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続を確認
    if ($conn->connect_error) {
        die("Failed to connect to the database: " . $conn->connect_error);
    }

    // 名前の重複をチェックするSQLクエリ
    $check_query = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // すでに同じ名前がデータベースに存在する場合は登録を拒否する
        echo "Error: This name is already registered.";
    } else {
        // データを挿入するSQLクエリ
        $sql = "INSERT INTO users (name, email, User_password, credit_card)
                VALUES ('$name', '$email', '$User_password', '$creditCard')";

        if ($conn->query($sql) === TRUE) {
            echo "A new record has been inserted into the database";
            sleep(2);
            header("Location: login.html");
    exit; // 必要に応じてスクリプトの実行を終了します
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
