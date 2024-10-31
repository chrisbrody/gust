<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Update Vision"; // Set page title
include './header/header.php';
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
                                  FROM user_vision WHERE user_id = ?");
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
        $stmt = $mysqli->prepare("INSERT INTO user_vision (user_id, career_goals, relationship_goals, financial_goals, health_goals, personal_growth_goals) 
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

<body>
    <?php include './menu/user_menu.php'; // Include user menu ?>

    <div class="container">
        <h1><div class="fs-14">Step 1:</div> Define Your Vision and Values</h1>
        <p>Reflect on your life goals for the next 5–10 years. Answer the questions below to set your vision.</p>

        <?php if ($success_message_vision) echo "<div class='alert alert-success'>$success_message_vision</div>"; ?>
        <?php if ($error_message_vision) echo "<div class='alert alert-danger'>$error_message_vision</div>"; ?>

        <form id="vision-form" method="POST" action="">
            <div class="form-group">
                <label for="career">Career Goals:</label>
                <textarea id="career" name="career" placeholder="What are your career aspirations?" required><?php echo htmlspecialchars($career_goals); ?></textarea>
            </div>
            <div class="form-group">
                <label for="relationships">Relationships Goals:</label>
                <textarea id="relationships" name="relationships" placeholder="What do you want in relationships?" required><?php echo htmlspecialchars($relationship_goals); ?></textarea>
            </div>
            <div class="form-group">
                <label for="finances">Financial Goals:</label>
                <textarea id="finances" name="finances" placeholder="What are your financial goals?" required><?php echo htmlspecialchars($financial_goals); ?></textarea>
            </div>
            <div class="form-group">
                <label for="health">Health Goals:</label>
                <textarea id="health" name="health" placeholder="What are your health goals?" required><?php echo htmlspecialchars($health_goals); ?></textarea>
            </div>
            <div class="form-group">
                <label for="personal-growth">Personal Growth Goals:</label>
                <textarea id="personal-growth" name="personal-growth" placeholder="What do you want to learn or achieve personally?" required><?php echo htmlspecialchars($personal_growth_goals); ?></textarea>
            </div>

            <input type="hidden" name="valid_submission" value="1">
            <button type="submit">Save Your Vision</button>
        </form>
    </div>

    <script>
        // Capture form submission
        document.getElementById('vision-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from refreshing the page

            // Capture user input from the form fields
            const careerGoal = document.getElementById('career').value.trim();
            const relationshipGoal = document.getElementById('relationships').value.trim();
            const financialGoal = document.getElementById('finances').value.trim();
            const healthGoal = document.getElementById('health').value.trim();
            const personalGrowthGoal = document.getElementById('personal-growth').value.trim();

            // Check for empty fields
            if (!careerGoal || !relationshipGoal || !financialGoal || !healthGoal || !personalGrowthGoal) {
                alert('Please fill in all the fields before submitting.'); // Alert the user
                return; // Stop further execution
            }
            
            setTimeout(() => {
                // Now submit the form if everything is valid
                document.getElementById('vision-form').submit();
            }, 3000);
        });
    </script>

    <script src="script.js"></script>
</body>
</html>
