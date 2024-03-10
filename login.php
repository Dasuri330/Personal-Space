<?php
session_start();

// Include your database connection file
include("database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data
    if (empty($email) || empty($password)) {
        echo '<script>alert("Please fill in both email and password.");</script>';
    } else {
        // Check username and password against database
        $sql = "SELECT * FROM user_data WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Verify the password
                if (isset($row['Password']) && password_verify($password, $row['Password'])) {
                    // Password is correct, log in the user
                    // Store user information in session variables
                    $_SESSION["user"] = "yes";
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["email"] = $row["Email"]; // Update key to match database column

                    // Redirect to main_menu.php
                    echo '<script>';
                    echo 'alert("Login successful.");';
                    echo 'window.location.href = "Personal.php";';
                    echo '</script>';
                    exit();
                } else {
                    echo '<script>alert("Incorrect password.");</script>';
                }
            } else {
                echo '<script>alert("Email does not exist.");</script>';
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Close database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
    <form id="loginForm">
        <h1>Login</h1>
        <div class="input-box">
            <input type="text" placeholder="Email" id="username" required>
            <i class='bx bxs-envelope'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" id="password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <button type="submit" class="btn" href="Personal.html">Login</button>
        <div class="register-link">
            <p>Don't have an account? <a href="registration.html">Register</a></p>
        </div>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Your login logic goes here (e.g., validate credentials)
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // Dummy validation: Check if username and password are not empty
            if (username.trim() !== '' && password.trim() !== '') {
                // Redirect to personal.html after successful login
                window.location.href = 'personal.php';
            } else {
                alert('Invalid username or password. Please try again.');
            }
        });
    </script>
</body>

</html>
