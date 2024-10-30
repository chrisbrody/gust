<?php
    // set page title
    $pageTitle = "Gust - Login";
    include './header/header.php';
?>
<body>
    <div id="login-container">
        <h2>Login with Google</h2>
        <div id="google-login-button"></div>
    </div>

    <!-- Google API Library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jwt-decode/3.1.2/jwt-decode.min.js"></script>
    <script>
        window.onload = function() {
            google.accounts.id.initialize({
                client_id: "555539819262-hcetrkg82s4erl43p59ol1b4547o47ba.apps.googleusercontent.com", // Replace with your actual Google Client ID
                callback: handleCredentialResponse,
            });

            // Render Google Sign-In button
            google.accounts.id.renderButton(
                document.getElementById("google-login-button"),
                { theme: "outline", size: "large" } // Customizable button
            );

            google.accounts.id.prompt(); // Optional: shows the One Tap dialog
        };

        function handleCredentialResponse(response) {            
            window.location.href = `./config/callback.php?token=${response.credential}`;
        }
    </script>
    <script src="script.js"></script>
</body>
</html>