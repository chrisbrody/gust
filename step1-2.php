<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Update Core Values"; // Set page title
$currentStep = 2; // Set the current pagination
include './header/header.php';
include './database/fetch_corevalues_data.php'; // This is where core values are fetched
?>

<body>
    <?php include './menu/user_menu.php'; // Include user menu ?>
    <?php include './step1_pagination.php'; // Include the pagination header ?>

    <div class="container">
        <h1><div class="fs-14">Step 1.2</div> Define Your Core Values</h1>
        <p>Core values are essential principles that guide your actions and decisions. Please define what matters most to you.</p>

        <?php if ($success_message_core) echo "<div class='alert alert-success'>$success_message_core</div>"; ?>
        <?php if ($error_message_core) echo "<div class='alert alert-danger'>$error_message_core</div>"; ?>

        <form id="core-values-form" method="POST" action="">
            <?php
            $coreValues = [
                'family' => ['label' => 'Family Core Values', 'value' => $family],
                'freedom' => ['label' => 'Freedom Core Values', 'value' => $freedom],
                'financial_independence' => ['label' => 'Financial Independence Core Values', 'value' => $financial_independence]
            ];

            foreach ($coreValues as $id => $coreValueData) {
                $label = $coreValueData['label'];
                $value = $coreValueData['value'];
            ?>
                <div class="form-group">
                    <label for="<?php echo $id; ?>"><?php echo $label; ?>:</label>
                    <div id="<?php echo $id; ?>-display" class="core-value-display" onclick="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')">
                        <?php echo htmlspecialchars($value) ?: "Click to add $label"; ?>
                    </div>
                    <textarea id="<?php echo $id; ?>" name="<?php echo $id; ?>" class="core-value-edit" style="display: none;" 
                              placeholder="Enter your <?php echo strtolower($label); ?>" onblur="toggleEdit('<?php echo $id; ?>', '<?php echo $label; ?>')"><?php echo htmlspecialchars($value); ?></textarea>
                </div>
            <?php } ?>

            <input type="hidden" name="valid_submission" value="1">
            <button type="submit">Save Your Core Values</button>
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
        function toggleEdit(fieldId, label) {
            const displayElement = document.getElementById(fieldId + '-display');
            const editElement = document.getElementById(fieldId);

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
        document.getElementById('core-values-form').addEventListener('submit', function(event) {
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
