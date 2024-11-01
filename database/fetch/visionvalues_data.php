<?php

include './database/connect.php'; // Include database connection

// Initialize variables for vision
$vision = ''; // Initialize the variable to avoid "undefined" warnings

// Fetch existing vision statement information if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare statement to fetch the vision statement
    $core_stmt = $mysqli->prepare("SELECT vision FROM vision_values WHERE user_id = ?");
    if ($core_stmt) {
        $core_stmt->bind_param("i", $user_id);
        $core_stmt->execute();
        $core_stmt->bind_result($vision);

        // Attempt to fetch the result
        if ($core_stmt->fetch()) {
            // Successfully fetched vision statement
        } else {
            // No vision statement found for this user, vision remains empty
        }
        $core_stmt->close();
    } else {
        // Log statement preparation error
        error_log("Failed to prepare statement: " . $mysqli->error);
    }
} else {
    // Log if user is not logged in
    error_log("User ID not set in session.");
}

// Initialize message variables
$success_message_core = '';
$error_message_core = '';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update vision info
    if (isset($_POST['valid_submission'])) {
        $vision = trim($_POST['vision_statement']); // Use the correct field name
        $user_id = $_SESSION['user_id'];

        // Prepare statement to update or insert vision info
        $stmt = $mysqli->prepare("INSERT INTO vision_values (user_id, vision) 
                                   VALUES (?, ?) 
                                   ON DUPLICATE KEY UPDATE 
                                   vision = ?");
        $stmt->bind_param("iss", 
            $user_id, 
            $vision, 
            $vision
        );

        if ($stmt->execute()) {
            $success_message_core = "Vision statement updated successfully!";
        } else {
            $error_message_core = "Error updating vision statement: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
