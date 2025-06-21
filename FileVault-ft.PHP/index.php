<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileVault</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>File Vault</nav>

    <?php
    session_start();
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user']['name'])) {
        echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user']['name']) . "</h1>";
        include "fileupload.php";
        echo '<button onclick="logOut()">Logout</button>';
    } else {
        echo "<h1>Welcome, Guest</h1>";
        echo "<p>Please login to upload & access your files</p>";
        include 'login.php';
    }
    ?>

<script>
    function logOut() {
        window.location.href = "logout.php";
    }
</script>
</body>
</html>