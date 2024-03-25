<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Profile</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                <li><a href="schedule.php">Class Schedule</a></li>
                <li><a href="index.<?php  ?>">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
      <?php if (isset($_SESSION['username'])): ?>
          <h2>Your Profile</h2>
          <!-- ユーザー情報の表示 -->
          <?php
          $servername = "localhost";
            $username = "root"; // データベースのユーザー名
            $password = "root"; // データベースのパスワード
            $dbname = "tatsus_gym_users"; // データベース名
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 接続を確認
            if ($conn->connect_error) {
                die("Failed to connect to the database: " . $conn->connect_error);
            }
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM users WHERE name='$username'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<p>Name: " . $row['name'] . "</p>";
              echo "<p>Email: " . $row['email'] . "</p>";
              echo "<p>Password: " . $row['User_password'] . "</p>";
              echo "<p>Credit Card: " . $row['credit_card'] . "</p>";
          }
          ?>
      <?php else: ?>
          <p>Please log in to view your profile.</p>
      <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Tatsu's website</p>
    </footer>
</body>
</html>
