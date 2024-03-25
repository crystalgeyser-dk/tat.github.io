<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを受け取る
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['User_password'];
    $creditCard = $_POST['creditCard'];

    // ファイルへの書き込み権限を確認し、なければエラーメッセージを返す
    if (!is_writable('userdata.txt')) {
        die("ファイルへの書き込み権限がありません。");
    }

    // データを整形して保存
    $data = "名前: $name, メールアドレス: $email, パスワード: $password, クレジットカード番号: $creditCard\n";
    if (file_put_contents('userdata.txt', $data, FILE_APPEND) !== false) {
        echo "会員登録が完了しました。";
    } else {
        echo "会員登録に失敗しました。再度お試しください。";
    }
}
?>
