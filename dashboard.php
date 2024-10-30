<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus();

// set page title
$pageTitle = "Gust - Dashboard";
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
        <div class="grid">            
            <div id="logout" class="text-right">
                <a href="./config/logout.php" id="sign-out-button">Sign Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Welcome <span id="user-info"></span> to Get Ur Shit Together, where we'll help you take charge of your life with clear, practical steps to reach your goals and build a fulfilling future. This journey will empower you to define what truly matters, assess where you are now, and create a path to the life you envision. Each step is designed to guide you in building lasting habits, securing your finances, and surrounding yourself with a support network that keeps you motivated. </p>
            </div>
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
                        <input type="text" id="new_name" name="new_name" required>
                    </div>
                    <button type="submit" name="update_name">Update Name</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="grid column-3 item-wrap">
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 1</div>
                    </div>
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 2</div>
                    </div>
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 3</div>
                    </div>
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 4</div>
                    </div>
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 5</div>
                    </div>
                    <div class="item">
                        <div>icon of step</div>
                        <div>name of step 6</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Display user information
        if (<?php echo json_encode($_SESSION['user_name']); ?>) {
            document.getElementById('user-info').innerHTML = `<span>${<?php echo json_encode($_SESSION['user_name']); ?>}</span>`;
        }
    </script>
    <script src="script.js"></script>
</body>
</html>