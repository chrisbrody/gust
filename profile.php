<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus();

// set page title
$pageTitle = "Gust - Update Profile";
include './header/header.php';

// Include database connection
include './database/connect.php';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_name'])) {
    $new_name = trim($_POST['new_name']);

    // Validate the input
    if (!empty($new_name)) {
        // Prepare an update statement
        $stmt = $mysqli->prepare("UPDATE users SET name = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_name, $_SESSION['user_email']);

        if ($stmt->execute()) {
            // Update session variable
            $_SESSION['user_name'] = $new_name;
            $success_message = "Name updated successfully!";
        } else {
            $error_message = "Error updating name: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "Please enter a valid name.";
    }
}
?>

<body>
    <div class="container">
        <div class="row">
            Update your profile information <?php echo ($_SESSION['user_name']); ?>
        </div>
        <!-- Form to change user name -->
        <div class="row">
            <div class="col">
                <h3>Change Your Name</h3>
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php elseif (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="new_name">New Name:</label>
                        <input type="text" id="new_name" name="new_name" required value="<?php echo ($_SESSION['user_name']); ?>">
                    </div>
                    <button type="submit" name="update_name">Update Name</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        
    </script>
</body>
</html>