<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '');

function connect()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    return $conn;
}

function executeQuery($sql)
{
    $conn = connect();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function fetchAssoc($result)
{
    return mysqli_fetch_assoc($result);
}
