<?php

    include './database/connect.php'; // Include database connection

    // Initialize variables for goals
    $career_goals = '';
    $relationship_goals = '';
    $financial_goals = '';
    $health_goals = '';
    $personal_growth_goals = '';

    // Fetch existing vision information if user is logged in
    $user_id = $_SESSION['user_id'];
    $vision_stmt = $mysqli->prepare("SELECT career_goals, relationship_goals, financial_goals, health_goals, personal_growth_goals 
                                    FROM live_values WHERE user_id = ?");
    $vision_stmt->bind_param("i", $user_id);
    $vision_stmt->execute();
    $vision_stmt->bind_result($career_goals, $relationship_goals, $financial_goals, $health_goals, $personal_growth_goals);
    $vision_stmt->fetch();
    $vision_stmt->close();

    // Initialize message variables
    $success_message_vision = '';
    $error_message_vision = '';

    // Check for form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update vision info
        if (isset($_POST['valid_submission'])) {
            $career_goals = trim($_POST['career']);
            $relationship_goals = trim($_POST['relationships']);
            $financial_goals = trim($_POST['finances']);
            $health_goals = trim($_POST['health']);
            $personal_growth_goals = trim($_POST['personal-growth']);
            $user_id = $_SESSION['user_id'];

            // Prepare statement to update or insert vision info
            $stmt = $mysqli->prepare("INSERT INTO live_values (user_id, career_goals, relationship_goals, financial_goals, health_goals, personal_growth_goals) 
                                    VALUES (?, ?, ?, ?, ?, ?) 
                                    ON DUPLICATE KEY UPDATE 
                                    career_goals = ?, relationship_goals = ?, financial_goals = ?, health_goals = ?, personal_growth_goals = ?");
            $stmt->bind_param("issssssssss", 
                $user_id, 
                $career_goals, 
                $relationship_goals, 
                $financial_goals, 
                $health_goals, 
                $personal_growth_goals, 
                $career_goals, 
                $relationship_goals, 
                $financial_goals, 
                $health_goals, 
                $personal_growth_goals
            );

            if ($stmt->execute()) {
                $success_message_vision = "Vision updated successfully!";
            } else {
                $error_message_vision = "Error updating vision: " . $stmt->error;
            }
            $stmt->close();
        }
    }

?>