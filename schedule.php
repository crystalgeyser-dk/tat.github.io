<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Class Schedule</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="registration.html">Membership</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Available Classes</h2>
        <ul>
            <?php include 'schedule_check.php'; ?>
        </ul>
    </main>

    <footer>
        <p>&copy; 2024 Tatsu's website</p>
    </footer>
</body>
</html>
