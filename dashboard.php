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

// ユーザー情報を取得
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE name='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No user found with this username.";
    }
}

// データベースからの切断
$conn->close();
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>dashboard</h1>


        <nav>
            <ul>
              　<li><a href="index.php">Log Out</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="schedule_dashboard.php">Class Schedule</a></li>
            </ul>
        </nav>
    </header>

    <main>


        <?php if (isset($_SESSION['username'])): ?>
              <p>Welcome, <?php echo $_SESSION['username']; ?></p>
              <a href="profile.php">View Profile</a>
          <?php endif; ?>
      

      <section id="dashboard">




          <div id="registrationUpdate">
              <h2>information update</h2>
              <form id="updateForm" action="update.php" method="POST">
          <div>
              <label for="name">Name:</label>

              <input type="text" id="name" name="name" pattern="[a-zA-Z0-9]+" title="Please enter letters and numbers only" value="<?php echo $row['name']; ?>" required>
          </div>
          <div>
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
          </div>
          <div>
              <label for="User_password">Password:</label>
              <input type="password" id="User_password" name="User_password" value="<?php echo $row['User_password']; ?>" required>
          </div>
          <div>
              <label for="creditCard">Credit Card:</label>

              <input type="text" id="creditCard" name="creditCard" pattern="[0-9]{16}" title="Please enter a valid 16-digit credit card number" value="<?php echo $row['credit_card']; ?>" required>
          </div>
          <button type="submit">Update</button>
      </form>
          </div>

      </section>

    </main>

    <footer>
        <p>&copy; 2024 Tatsu's website</p>
    </footer>
</body>
</html>
