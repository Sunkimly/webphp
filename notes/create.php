<?php
require '../includes/auth.php';
require '../includes/config.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $msg = "Error saving note.";
        }
    } else {
        $msg = "Both title and content are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2>Add Note</h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button class="btn btn-success">Save Note</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
