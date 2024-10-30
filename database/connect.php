<?php 
    // Function to load .env variables
    function loadEnv($file)
    {
        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Remove comments and trim whitespace
                $line = trim(preg_replace('/\s*#.*$/', '', $line));
                if (!empty($line)) {
                    list($key, $value) = explode('=', $line, 2);
                    putenv(trim($key) . '=' . trim($value)); // Set the environment variable
                    $_ENV[trim($key)] = trim($value); // Optional: Set it in the $_ENV array
                }
            }
        }
    }

    // Load the environment variables
    loadEnv(__DIR__ . '/../.env');

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

