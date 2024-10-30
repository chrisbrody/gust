<?php
    include 'auth.php'; // Include the authentication functions
    checkLoginStatus();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Define Your Vision and Values</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="grid column-2 align-center justify-between">
            <div id="user-info"></div>
            <div id="logout" class="text-right">
                <a href="logout.php" id="sign-out-button">Sign Out</a>
            </div>
        </div>
        
        <h1>Step 1: Define Your Vision and Values</h1>
        <p>Reflect on your life goals for the next 5–10 years. Answer the questions below to set your vision.</p>

        <form id="vision-form">
            <div class="form-group">
                <label for="career">Career Goals:</label>
                <textarea id="career" name="career" placeholder="What are your career aspirations?"></textarea>
            </div>
            <div class="form-group">
                <label for="relationships">Relationships Goals:</label>
                <textarea id="relationships" name="relationships" placeholder="What do you want in relationships?"></textarea>
            </div>
            <div class="form-group">
                <label for="finances">Financial Goals:</label>
                <textarea id="finances" name="finances" placeholder="What are your financial goals?"></textarea>
            </div>
            <div class="form-group">
                <label for="health">Health Goals:</label>
                <textarea id="health" name="health" placeholder="What are your health goals?"></textarea>
            </div>
            <div class="form-group">
                <label for="personal-growth">Personal Growth Goals:</label>
                <textarea id="personal-growth" name="personal-growth" placeholder="What do you want to learn or achieve personally?"></textarea>
            </div>

            <button type="submit">Save Your Vision</button>
        </form>

        <div id="result" class="result"></div>
    </div>

    <script>
        // Display user information
        if (<?php echo json_encode($_SESSION['user_name']); ?>) {
            document.getElementById('user-info').innerHTML = `<p>Welcome: ${<?php echo json_encode($_SESSION['user_name']); ?>}</p>`;
        } else {
            document.getElementById('user-info').innerHTML = '<p>No user information available.</p>';
        }

        
        // Capture form submission
        document.getElementById('vision-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from refreshing the page

            // Capture user input from the form fields
            const careerGoal = document.getElementById('career').value;
            const relationshipGoal = document.getElementById('relationships').value;
            const financialGoal = document.getElementById('finances').value;
            const healthGoal = document.getElementById('health').value;
            const personalGrowthGoal = document.getElementById('personal-growth').value;

            // Create a summary of the user’s vision
            const result = `
                <h2>Your Vision Summary</h2>
                <p><strong>Career Goals:</strong> ${careerGoal}</p>
                <p><strong>Relationships Goals:</strong> ${relationshipGoal}</p>
                <p><strong>Financial Goals:</strong> ${financialGoal}</p>
                <p><strong>Health Goals:</strong> ${healthGoal}</p>
                <p><strong>Personal Growth Goals:</strong> ${personalGrowthGoal}</p>
            `;

            // Display the result
            document.getElementById('result').innerHTML = result;
        });
    </script>

    <script src="script.js"></script>
</body>
</html>