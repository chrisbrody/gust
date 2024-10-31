<!-- user_menu.php -->
<?php
    // Get the current script name
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="grid">
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