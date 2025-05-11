<?php
// base.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="base.php">MyPortfolio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- ms-auto to push to right -->
                <li class="nav-item">
                    <a class="nav-link" href="base.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Projects</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to My Project</h1>

    <div class="card mx-auto shadow" style="max-width: 600px;">
        <div class="card-body">
            <h4 class="card-title">About Me</h4>
            <p class="card-text"><strong>Name:</strong>Sun Kimly</p>
            <p class="card-text"><strong>Gender:</strong> Female</p>
            <p class="card-text"><strong>Class:</strong> Class A4</p>
            <p class="card-text"><strong>About Project:</strong> This project is a simple Note App built using PHP and MySQL.</p>

            <div class="d-grid">
                <a href="index.php" class="btn btn-primary">🔗 Go to Project</a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
