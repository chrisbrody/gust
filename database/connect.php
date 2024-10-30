<?php 
    require_once __DIR__ . '/../config/helpers/EnvLoader.php';

    // Load the environment variables
    EnvLoader::load(__DIR__ . '/../.env');

    // Retrieve environment variables
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');

    // create new connection to database
    $mysqli = new mysqli($host, $username, $password, $dbname);

    // if it erros cancel the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
?>

