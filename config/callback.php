<?php
session_start();
include '../database/connect.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $client_id = "555539819262-hcetrkg82s4erl43p59ol1b4547o47ba.apps.googleusercontent.com";

    // Validate and decode the ID token
    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;
    $response = file_get_contents($url);
    $user_data = json_decode($response, true);

    if (isset($user_data['aud']) && $user_data['aud'] === $client_id) {
        // Prepare user data for the next step
        $_SESSION['user_name'] = $user_data['name'];
        $_SESSION['user_email'] = $user_data['email'];
        $_SESSION['access_token'] = $token;

        // Add data to the database
        $user_email = $_SESSION['user_email'];

        // Check if the user already exists
        $check_stmt = $mysqli->prepare("SELECT name FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $user_email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            // User exists, fetch their existing name
            $check_stmt->bind_result($existing_name); 
            $check_stmt->fetch();

            // Do not update the name if the user already exists
            $_SESSION['user_name'] = $existing_name; // Maintain the existing name in session
        } else {
            // User does not exist, insert a new record
            $user_name = $_SESSION['user_name'];
            $stmt = $mysqli->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->bind_param("ss", $user_name, $user_email);

            // Execute the statement
            if (!$stmt->execute()) {
                // Handle error
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }

        // Close the check statement
        $check_stmt->close();

        // Redirect to dashboard.php with user data
        header("Location: ../dashboard.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "<p>Invalid login.</p>";
    }
} else {
    echo "<p>No token provided.</p>";
}
?>