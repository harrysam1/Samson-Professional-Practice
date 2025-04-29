<?php
session_start();
include "config.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        header("Location: index.html");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - HS Clothing</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFA500, #000000, #FFFFFF, #8EC5FC, #E0C3FC);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row shadow-lg rounded overflow-hidden" style="max-width: 800px; width: 100%;">
        <!-- Logo section -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
            <img src="images/Hgif.gif" alt="Logo" class="img-fluid p-4" style="max-height: 150px;">
        </div>

        <!-- Login form section -->
        <div class="col-md-6 bg-white p-4">
            <h2 class="text-center fw-bold mb-4">Login</h2>

            <?php
            if (isset($_SESSION['signup_success'])) {
                echo "<div class='alert alert-success text-center'>{$_SESSION['signup_success']}</div>";
                unset($_SESSION['signup_success']);
            }
            if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>";
            ?>

            <form method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="signup.php">Signup here</a></p>
        </div>
    </div>
</div>
</body>
</html>
