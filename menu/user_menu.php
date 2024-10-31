<!-- user_menu.php -->
<?php
    // Get the current script name
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
    /* General styles for the navigation grid */
.nav.grid {
    display: flex; /* Use flexbox for layout */
    justify-content: flex-end; /* Align items to the right */
    gap: 20px; /* Space between menu items */
    padding: 10px; /* Vertical padding for the menu */
    background-color: #f8f9fa; /* Light background color */
    border-bottom: 1px solid #dee2e6; /* Bottom border for separation */
}

/* Individual menu item styles */
.nav .text-right {
    margin: 0; /* Remove any margin */
}

/* Navigation link styles */
.nav a {
    text-decoration: none; /* Remove underline from links */
    color: #007bff; /* Blue color for links */
    font-weight: bold; /* Bold font for emphasis */
    padding: 10px 15px; /* Padding around links */
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
}

/* Hover effects for links */
.nav a:hover {
    background-color: #007bff; /* Change background on hover */
    color: white; /* Change text color on hover */
}

/* Active link style (if you want to highlight the current page) */
.nav a.active {
    background-color: #0056b3; /* Darker blue for active link */
    color: white; /* White text for active link */
}
</style>

<div class="nav grid">
    <?php if ($current_page !== 'profile.php') : ?>
        <div id="profile" class="text-right">
            <a href="./profile.php" id="profile-button">Profile</a>
        </div>  
    <?php endif; ?>

    <?php if ($current_page !== 'dashboard.php') : ?>
        <div id="dashboard" class="text-right">
            <a href="./dashboard.php" id="dashboard-button">Dashboard</a>
        </div>            
    <?php endif; ?>          
    <div id="logout" class="text-right">
        <a href="./config/logout.php" id="sign-out-button">Sign Out</a>
    </div>
</div>