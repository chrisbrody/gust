<?php 
include './database/connect.php';
// Initialize total counter
$total = 0;

// Reusable function to fetch goals and count non-empty values
function countNonEmptyGoals($mysqli, $user_id, $query, $columns) {
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result(...$columns); // Use splat operator to bind results dynamically
    $stmt->fetch();
    $stmt->close();

    // Count non-empty goals using array_filter
    return count(array_filter($columns, function($goal) {
        return !empty(trim($goal)); // Check if the goal is not empty after trimming whitespace
    }));
}

// Fetch and count life_values goals
$life_values_query = "SELECT career_goals, relationship_goals, financial_goals, health_goals, personal_growth_goals FROM life_values WHERE user_id = ?";
$life_values_columns = ['career_goals', 'relationship_goals', 'financial_goals', 'health_goals', 'personal_growth_goals'];
$total += countNonEmptyGoals($mysqli, $_SESSION['user_id'], $life_values_query, $life_values_columns);

// Fetch and count core_values goals
$core_values_query = "SELECT family, freedom, financial_independence FROM core_values WHERE user_id = ?";
$core_values_columns = ['family', 'freedom', 'financial_independence'];
$total += countNonEmptyGoals($mysqli, $_SESSION['user_id'], $core_values_query, $core_values_columns);

// Fetch and count vision_values goals
$vision_values_query = "SELECT vision FROM vision_values WHERE user_id = ?";
$vision_values_columns = ['vision'];
$total += countNonEmptyGoals($mysqli, $_SESSION['user_id'], $vision_values_query, $vision_values_columns);

// Close the database connection
$mysqli->close();

?>