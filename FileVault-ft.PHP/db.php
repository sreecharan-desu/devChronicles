<?php
function queryDB($userquery) {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "my-secret-pw";
    $dbname = "mydb";
    $port = 3306;
    $connection = new mysqli($servername, $username, $password, $dbname, $port);

    if ($connection->connect_error) {
        echo "Failed to connect";
    }
    $res = $connection->query($userquery);

    if ($res) {
        // echo "Query executed successfully";
        return $res;
    } else {
        echo "Failed to execute querry";
        return false;
    }
}
?>