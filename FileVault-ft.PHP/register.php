<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileVault - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>FileVault</nav>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
        <p>Already have an account? Please login <a href="./login.php">here</a>.</p>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'db.php';
    session_start();

    if (empty($_POST['username']) || empty($_POST['password'])) {
        die("Username and password are required");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $add_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    $result = queryDB($add_user_query);

    if ($result) {
        $_SESSION['user'] = ['name' => $username];
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to register user";
    }
}
?>
</body>
</html>