<?php
require_once '../vendor/autoload.php';

use App\Controller\UsersController;
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signin-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .signin-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .signin-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .signin-form input[type="email"],
        .signin-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .signin-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .signin-form button:hover {
            background-color: #0056b3;
        }
        .signin-form .signup-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .signin-form .signup-link a {
            color: #007bff;
            text-decoration: none;
        }
        .signin-form .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form class="signin-form" action="login.php" method="POST">
        <h2>Sign In</h2>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <button type="submit">Sign In</button>
        
        <div class="signup-link">
            Don't have an account? <a href="sign_up.php">Signup here</a>
        </div>
    </form>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__.'/../src/Controller/UsersController.php';
    $isLoggedIn = UsersController::login($_POST['email'], $_POST['password']);
    if ($isLoggedIn) {
        header("Location:../src/view/dashboard.php");
         exit;
    } else {
        echo "Invalid credentials!";
    }
}

?>
</body>
</html>
