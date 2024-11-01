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

$current_situation_percentage = 0; // Set to 0% initially
$actionable_goals_percentage = 0; // Set to 0% initially
$financial_plan_percentage = 0; // Set to 0% initially
$daily_routine_percentage = 0; // Set to 0% initially
$support_system_percentage = 0; // Set to 0% initially
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
                    <a class="item" href="./current-situation.php">
                        <div>Current Situation</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $current_situation_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($current_situation_percentage) ?>%</div>
                    </a>
                    <a class="item" href="./actionable-goals.php">
                        <div>Actionable Goals</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $actionable_goals_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($actionable_goals_percentage) ?>%</div>
                    </a>

                    <a class="item" href="./financial-plan.php">
                        <div>Financial Plan</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $financial_plan_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($financial_plan_percentage) ?>%</div>
                    </a>

                    <a class="item" href="./daily-routine.php">
                        <div>Daily Routine</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $daily_routine_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($daily_routine_percentage) ?>%</div>
                    </a>

                    <a class="item" href="./support-system.php">
                        <div>Support System</div>
                        <br>
                        <div style="width: 100%; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= $support_system_percentage ?>%; background-color: #4caf50; height: 10px;"></div>
                        </div>
                        <div style="text-align: center; font-weight: bold;"><?= number_format($support_system_percentage) ?>%</div>
                    </a>
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