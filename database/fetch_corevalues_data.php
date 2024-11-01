<?php

include './database/connect.php'; // Include database connection

// Initialize variables for core values
$family = '';
$freedom = '';
$financial_independence = '';

// Fetch existing core values information if user is logged in
$user_id = $_SESSION['user_id'];
$core_stmt = $mysqli->prepare("SELECT family, freedom, financial_independence FROM core_values WHERE user_id = ?");
$core_stmt->bind_param("i", $user_id);
$core_stmt->execute();
$core_stmt->bind_result($family, $freedom, $financial_independence);
$core_stmt->fetch();
$core_stmt->close();

// Initialize message variables
$success_message_core = '';
$error_message_core = '';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update core values info
    if (isset($_POST['valid_submission'])) {
        $family = trim($_POST['family']);
        $freedom = trim($_POST['freedom']);
        $financial_independence = trim($_POST['financial_independence']);
        $user_id = $_SESSION['user_id'];

        // Prepare statement to update or insert core values info
        $stmt = $mysqli->prepare("INSERT INTO core_values (user_id, family, freedom, financial_independence) 
                                    VALUES (?, ?, ?, ?) 
                                    ON DUPLICATE KEY UPDATE 
                                    family = ?, freedom = ?, financial_independence = ?");
        $stmt->bind_param("issssss", 
            $user_id, 
            $family, 
            $freedom, 
            $financial_independence, 
            $family, 
            $freedom, 
            $financial_independence
        );

        if ($stmt->execute()) {
            $success_message_core = "Core values updated successfully!";
        } else {
            $error_message_core = "Error updating core values: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
