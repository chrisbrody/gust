<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Update Vision"; // Set page title
$currentStep = 1; // Set the current pagination
include './header/header.php';
include './database/fetch/lifevalues_data.php';
?>

<body>
    <?php include './menu/user_menu.php'; // Include user menu ?>
    <?php include './components/Loader.php'; // Include Loading Overlay?>
    <?php include './step1_pagination.php'; // Include the pagination header ?>

    <div class="container">
        <h1><div class="fs-14">Step 1.1</div> Reflect on Life Goals</h1>
        <p>Take a moment to think deeply about what you want from life in the next 5–10 years. Visualize your goals across key areas—your career, relationships, financial health, physical and mental wellness, and personal growth. These reflections will guide your journey and help you define what success and happiness truly mean to you.</p>

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
            <button type="submit">Save Your Life Goals</button>
        </form>
    </div>

    <script src="./scripts/components/toggleEdit.js"></script>
    <script>
        // Capture form submission
        document.getElementById('vision-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from refreshing the page

            // Show the loading overlay
            document.getElementById('loading-overlay').style.display = 'flex';
            
            setTimeout(() => {
                // Now submit the form if everything is valid
                document.getElementById('vision-form').submit();
            }, 3000);
        });
    </script>

    <script src="script.js"></script>
</body>
</html>
