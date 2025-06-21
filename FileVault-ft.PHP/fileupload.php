<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileVault - Upload</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Upload File</h1>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required>
        <input type="submit" value="Upload File" name="submit">
    </form>

    <img src="" id="display" style="max-width: 300px; margin-top: 20px; display: none;"/>
    
    <?php
    session_start();
    include "db.php";

    $username = $_SESSION['user']['name'];
    $query = "SELECT * FROM users_files WHERE username = '$username';";
    $res = queryDB($query);
    if($res && mysqli_num_rows($res)>0){
        foreach($res as $file){
            echo '<img src="' . explode('$',$file['filepath'])[1] . '"/>';
            echo "<br />";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
        $uploadDir = "uploads/$username/";
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileName = basename($_FILES['fileToUpload']['name']);
        $targetPath = $uploadDir . $fileName;
        $fileType = strtolower(string: pathinfo($targetPath, PATHINFO_EXTENSION));
        $username = $_SESSION['user']['name'];
        
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt'];
        $maxFileSize = 5 * 1024 * 1024;
        
        if (!in_array($fileType, $allowedTypes)) {
            echo "<p style='color:red'>Error: Only JPG, PNG, GIF, PDF, and TXT files are allowed.</p>";
        } elseif ($_FILES['fileToUpload']['size'] > $maxFileSize) {
            echo "<p style='color:red'>Error: File too large. Maximum size is 5MB.</p>";
        } elseif (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath)) {
            echo "<p style='color:green'>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";

            $query = "INSERT INTO users_files (username,filepath) VALUES('$username','$$targetPath')";
            $res = queryDB($query);
            if($res){
                header("Location:index.php");
                exit();
            }


            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo "<script>$('#display').attr('src', '$targetPath').show();</script>";
            }
        } else {
            echo "<p style='color:red'>Error uploading file.</p>";
        }
    }
    ?>

<script>
    $((function() {
        const fileToUpload = $("#fileToUpload");
        fileToUpload.change(function() {
            const file = this.files[0];
            if (file && file.type.match('image.*')) {
                const imageUrl = URL.createObjectURL(file);
                $("#display").attr("src", imageUrl).show();
            } else {
                $("#display").hide();
            }
        });
    }));
</script>
</body>
</html>