<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileVault - Login</title>
</head>

<body>
    <nav>FileVault - Login</nav>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? Please register <a href="./register.php">here</a>.</p>
    </form>

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once 'db.php';

        // Basic validation
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "<p style='color:red'>Username and password are required</p>";
        } else {
            // Very basic sanitization (not secure for production!)
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Fixed SQL query syntax
            $search_user_query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            
            $result = queryDB($search_user_query);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $_SESSION['user'] = ['name' => $username];
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color:red'>Invalid username or password</p>";
            }
        }
    }
    ?>
</body>
</html>