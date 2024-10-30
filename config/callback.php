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

    // echo $response;
    // die();

    if (isset($user_data['aud']) && $user_data['aud'] === $client_id) {
        // Prepare user data for the next step
        $_SESSION['user_name'] = $user_data['name'];
        $_SESSION['user_email'] = $user_data['email'];
        $_SESSION['access_token'] = $token;

        // add data to database

        // Redirect to dashbaord.php with user data
        header("Location: ../dashboard.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "<p>Invalid login.</p>";
    }
} else {
    echo "<p>No token provided.</p>";
}
?>