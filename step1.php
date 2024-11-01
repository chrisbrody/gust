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
            <?php
            $goals = [
                'career' => ['label' => 'Career Goals', 'value' => $career_goals],
                'relationships' => ['label' => 'Relationships Goals', 'value' => $relationship_goals],
                'finances' => ['label' => 'Financial Goals', 'value' => $financial_goals],
                'health' => ['label' => 'Health Goals', 'value' => $health_goals],
                'personal-growth' => ['label' => 'Personal Growth Goals', 'value' => $personal_growth_goals]
            ];

            foreach ($goals as $id => $goalData) {
                $label = $goalData['label'];
                $value = $goalData['value'];
            ?>
                <div class="form-group">
                    <label for="<?php echo $id; ?>"><?php echo $label; ?>:</label>
                    <div id="<?php echo $id; ?>-display" class="goal-display" onclick="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')">
                        <?php echo htmlspecialchars($value) ?: "Click to add $label"; ?>
                    </div>
                    <textarea id="<?php echo $id; ?>" name="<?php echo $id; ?>" class="goal-edit" style="display: none;"
                            placeholder="Enter your <?php echo strtolower($label); ?>" onblur="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')"><?php echo htmlspecialchars($value); ?></textarea>
                </div>
            <?php } ?>

            <input type="hidden" name="valid_submission" value="1">
            <button type="submit">Save Your Vision</button>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay">
        <svg width="50" height="50" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="35" stroke-width="5" stroke="#333" fill="none" stroke-dasharray="164.93361431346415 56.97787143782138">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
        </svg>
    </div>

    <script>
        function toggleEdit(goalId, label) {
            const displayElement = document.getElementById(goalId + '-display');
            const editElement = document.getElementById(goalId);

            // Toggle visibility based on current state
            if (displayElement.style.display !== 'none') {
                displayElement.style.display = 'none';
                editElement.style.display = 'block';
                editElement.focus();
            } else {
                // Update display text with textarea value or a custom message based on the label
                const newValue = editElement.value.trim();
                displayElement.textContent = newValue || `Click here to add ${label}`;

                displayElement.style.display = 'block';
                editElement.style.display = 'none';
            }
        }

        // Capture form submission
        document.getElementById('vision-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from refreshing the page

            // Show the loading overlay
            document.getElementById('loading-overlay').style.display = 'flex';

            // Capture user input from the form fields
            const careerGoal = document.getElementById('career').value.trim();
            const relationshipGoal = document.getElementById('relationships').value.trim();
            const financialGoal = document.getElementById('finances').value.trim();
            const healthGoal = document.getElementById('health').value.trim();
            const personalGrowthGoal = document.getElementById('personal-growth').value.trim();

            // // Check for empty fields
            // if (!careerGoal || !relationshipGoal || !financialGoal || !healthGoal || !personalGrowthGoal) {
            //     document.getElementById('loading-overlay').style.display = 'none';
            //     alert('Please fill in all the fields before submitting.'); // Alert the user
            //     return; // Stop further execution
            // }
            
            setTimeout(() => {
                // Now submit the form if everything is valid
                document.getElementById('vision-form').submit();
            }, 3000);
        });
    </script>

    <script src="script.js"></script>
</body>
</html>
