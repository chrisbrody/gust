<?php
    session_start(); // Start the session

    // Function to verify the access token
    function verifyAccessToken($token) {
        $client_id = "555539819262-hcetrkg82s4erl43p59ol1b4547o47ba.apps.googleusercontent.com";
        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;
        $response = file_get_contents($url);
        $user_data = json_decode($response, true);

        // Check if token is valid and audience matches
        if (isset($user_data['aud']) && $user_data['aud'] === $client_id) {
            return $user_data; // Token is valid, return user data
        }
        return false; // Invalid token
    }

    // Function to check user login status and redirect if not logged in
    function checkLoginStatus() {
        if (!isset($_SESSION['access_token']) || !verifyAccessToken($_SESSION['access_token'])) {
            header("Location: ../login.php"); // Redirect to login page
            exit(); // Ensure no further code is executed after the redirect
        }
    }
?>