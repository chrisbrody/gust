<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Update Core Values"; // Set page title
$currentStep = 2; // Set the current pagination
include './header/header.php';
include './database/fetch/corevalues_data.php'; // This is where core values are fetched
?>

<body>
    <?php include './menu/user_menu.php'; // Include user menu ?>
    <?php include './components/Loader.php'; // Include Loading Overlay?>
    <?php include './step1_pagination.php'; // Include the pagination header ?>

    <div class="container">
        <h1><div class="fs-14">Step 1.2</div> Identify Core Values</h1>
        <p>Now, identify the core values that matter most in your life, like family, freedom, or financial independence. These values are your foundation—they influence your decisions and priorities, shaping your future to reflect what you truly believe in.</p>

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

    <script src="./scripts/components/toggleEdit.js"></script>
    <script>
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
</body>
</html>
