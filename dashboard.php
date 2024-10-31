<?php
include './config/auth.php'; // Include the authentication functions
checkLoginStatus();

// set page title
$pageTitle = "Gust - Dashboard";
include './header/header.php';
?>

<body>
    <?php include './menu/user_menu.php'; ?>
    
    <div class="container">
        <div class="row">
            <div class="col">
                <p>Welcome <span id="user-info"></span> to Get Ur Shit Together, where we'll help you take charge of your life with clear, practical steps to reach your goals and build a fulfilling future. This journey will empower you to define what truly matters, assess where you are now, and create a path to the life you envision. Each step is designed to guide you in building lasting habits, securing your finances, and surrounding yourself with a support network that keeps you motivated. </p>
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