<?php
require '../includes/config.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        $msg = "Username already taken!";
    }

    $stmt->close();
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Register</h2>
    <form method="POST">
        <div class="mb-2">
            <input type="text" name="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="mb-2">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Register</button>
        <p class="text-danger mt-2"><?= $msg ?></p>
        <p class="mt-2">Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>
