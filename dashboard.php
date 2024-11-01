<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus();

// set page title
$pageTitle = "Gust - Dashboard";
include './header/header.php';
include './database/fetch/total_count_step1.php';

$vision_percentage = ($total / 9) * 100;
$vision_percentage = min(max($vision_percentage, 0), 100); // Ensure percentage is within 0-100 range
$vision_percentage = round($vision_percentage); // Round to the nearest whole number
?>

<body>
    <?php include './menu/user_menu.php'; ?>
    
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><div class="fs-14">Welcome <span id="user-info"></span> to</div> Get Ur Shit Together</h1>
                <p>You're here to take charge of your life with clear, practical steps to reach your goals and build a fulfilling future. This journey will empower you to define what truly matters, assess where you are now, and create a path to the life you envision. Each step is designed to guide you in building lasting habits, securing your finances, and surrounding yourself with a support network that keeps you motivated. </p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="grid column-3 item-wrap">
                    <a class="item" href="./step1-1.php">
                        <div>Vision &amp; Values</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $vision_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($vision_percentage) ?>%</div>
                    </a>
                    <div class="item">
                        <div>Current Situation</div>
                    </div>
                    <div class="item">
                        <div>Actionable Goals</div>
                    </div>
                    <div class="item">
                        <div>Financial Plan</div>
                    </div>
                    <div class="item">
                        <div>Daily Routine</div>
                    </div>
                    <div class="item">
                        <div>Support System</div>
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