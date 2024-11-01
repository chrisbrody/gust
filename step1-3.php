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
    <?php include './step1_pagination.php'; // Include the pagination header ?>

    <div class="container">
        <h1><div class="fs-14">Step 1.3</div> Create Your Vision Statement</h1>
        <p>In a few sentences, outline your ideal life. This helps guide decisions and motivates action.</p>

        <?php if ($success_message_core) echo "<div class='alert alert-success'>$success_message_core</div>"; ?>
        <?php if ($error_message_core) echo "<div class='alert alert-danger'>$error_message_core</div>"; ?>

        <form id="vision-statement-form" method="POST" action="">
            <div class="form-group">
                <label for="vision_statement">Vision Statement:</label>
                
                <!-- Display area for the vision statement -->
                <div id="vision-display" class="core-value-display" onclick="toggleEdit('vision_statement')">
                    <?php echo htmlspecialchars($vision) ?: "Click to add your vision statement"; ?>
                </div>
                
                <!-- Editable textarea for the vision statement -->
                <textarea id="vision_statement" name="vision_statement" class="core-value-edit" style="display: none;" 
                          placeholder="Enter your vision statement here..." onblur="toggleEdit('vision_statement')"><?php echo htmlspecialchars($vision); ?></textarea>
            </div>

            <input type="hidden" name="valid_submission" value="1">
            <button type="submit">Save Your Vision Statement</button>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" style="display: none;">
        <svg width="50" height="50" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="35" stroke-width="5" stroke="#333" fill="none" stroke-dasharray="164.93361431346415 56.97787143782138">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
        </svg>
    </div>

    <script>
        function toggleEdit(fieldId) {
            const displayElement = document.getElementById('vision-display');
            const editElement = document.getElementById(fieldId);

            // Toggle visibility based on current state
            if (displayElement.style.display !== 'none') {
                displayElement.style.display = 'none';
                editElement.style.display = 'block';
                editElement.focus();
            } else {
                // Update display text with textarea value or a custom message
                const newValue = editElement.value.trim();
                displayElement.textContent = newValue || "Click to add your vision statement";

                displayElement.style.display = 'block';
                editElement.style.display = 'none';
            }
        }

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

    <script src="script.js"></script>
</body>
</html>
