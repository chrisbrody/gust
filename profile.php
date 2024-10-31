<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus(); // Confirm user is logged in
$pageTitle = "Gust - Update Profile"; // Set page title
include './header/header.php';
include './database/connect.php'; // Include database connection

// Initialize variables for phone and birthday
$phone = '';
$birthday = '';

// Fetch existing profile information if user is logged in
$user_id = $_SESSION['user_id'];
$profile_stmt = $mysqli->prepare("SELECT phone, birthday FROM profiles WHERE user_id = ?");
$profile_stmt->bind_param("i", $user_id);
$profile_stmt->execute();
$profile_stmt->bind_result($phone, $birthday);
$profile_stmt->fetch();
$profile_stmt->close();

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update profile info (name, phone number, and birthday)
    if (isset($_POST['update_profile'])) {
        $name = trim($_POST['new_name']);
        $phone = trim($_POST['phone']);
        $birthday = trim($_POST['birthday']);
        $user_id = $_SESSION['user_id'];

        // Prepare statement to update or insert profile info
        $stmt = $mysqli->prepare("INSERT INTO profiles (user_id, phone, birthday, name) VALUES (?, ?, ?, ?) 
                                  ON DUPLICATE KEY UPDATE phone = ?, birthday = ?, name = ?");
        $stmt->bind_param("issssss", $user_id, $phone, $birthday, $name, $phone, $birthday, $name);

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name; // Update session name
            $success_message_profile = "Profile updated successfully!";
        } else {
            $error_message_profile = "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<body>
    <div class="container">
        <?php include './menu/user_menu.php'; ?>
        <div class="row">
            Update your profile information, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </div>

        <!-- Form to update name, phone number, and birthday -->
        <div class="row">
            <div class="col">
                <h3>Update Profile Information</h3>
                <?php if (isset($success_message_profile)) echo "<div class='alert alert-success'>$success_message_profile</div>"; ?>
                <?php if (isset($error_message_profile)) echo "<div class='alert alert-danger'>$error_message_profile</div>"; ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="new_name">Name:</label>
                        <input type="text" id="new_name" name="new_name" required value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Number:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($birthday); ?>">
                    </div>
                    <button type="submit" name="update_profile">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
