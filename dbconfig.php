<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'Nkl@2323');
    define('DB_NAME', 'dbpro');

    //Try connecting to the Database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Check the connection
    if($conn == false)
    {
        die('Error: Cannot connect');
    }
?>