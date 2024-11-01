<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Create Vision Statement"; // Set page title
$currentStep = 3; // Set the current pagination step
include './header/header.php';
include './database/fetch/visionvalues_data.php'; // This is where core values are fetched
?>

<body>
    <?php include './menu/user_menu.php'; // Include user menu ?>
    <?php include './components/Loader.php'; // Include Loading Overlay?>
    <?php include './step1_pagination.php'; // Include the pagination header ?>

    <div class="container">
        <h1><div class="fs-14">Step 1.3</div> Create A Vision Statement</h1>
        <p>Using your reflections and values, craft a personal vision statement. In just a few sentences, outline your ideal life. This vision statement will serve as a guiding force, keeping you inspired and aligned as you work toward your goals.</p>

        <?php if ($success_message_core) echo "<div class='alert alert-success'>$success_message_core</div>"; ?>
        <?php if ($error_message_core) echo "<div class='alert alert-danger'>$error_message_core</div>"; ?>

        <form id="vision-statement-form" method="POST" action="">
            <?php
            // Define the vision statement with a label and value
            $visionStatement = [
                'vision_statement' => [
                    'label' => 'Vision Statement',
                    'value' => $vision // Assuming $vision holds the current vision statement value
                ]
            ];

            foreach ($visionStatement as $id => $statementData) {
                $label = $statementData['label'];
                $value = $statementData['value'];
            ?>
                <div class="form-group">
                    <label for="<?php echo $id; ?>"><?php echo $label; ?>:</label>
                    <div id="<?php echo $id; ?>-display" class="goal-display" onclick="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')">
                        <?php echo htmlspecialchars($value) ?: "Click to add your vision statement"; ?>
                    </div>
                    <textarea id="<?php echo $id; ?>" name="<?php echo $id; ?>" class="goal-edit" style="display: none;"
                            placeholder="Enter your <?php echo strtolower($label); ?>" 
                            onblur="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')"><?php echo htmlspecialchars($value); ?></textarea>
                </div>
            <?php } ?>

            <input type="hidden" name="valid_submission" value="1">
            <button type="submit">Save Your Vision Statement</button>
        </form>
    </div>

    <script src="./scripts/components/toggleEdit.js"></script>
    <script>
        // Capture form submission
        document.getElementById('vision-statement-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from refreshing the page

            // Show the loading overlay
            document.getElementById('loading-overlay').style.display = 'flex';

            // Now submit the form if everything is valid after a short delay
            setTimeout(() => {
                this.submit();
            }, 3000);
        });
    </script>
</body>
</html>
