<?php
session_start();
require '../includes/config.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: ../notes/index.php");
            exit;
        } else {
            $msg = "Invalid password!";
        }
    } else {
        $msg = "User not found!";
    }

    $stmt->close();
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Login</h2>
    <form method="POST">
        <div class="mb-2">
            <input type="text" name="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="mb-2">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Login</button>
        <p class="text-danger mt-2"><?= $msg ?></p>
        <p class="mt-2">Don't have an account? <a href="register.php">Register</a></p>
    </form>
</body>
</html>
