<?php
require '../includes/auth.php';        // Auth check
require '../includes/config.php';      // DB connection

$user_id = $_SESSION['user_id'];

// Fetch user’s notes
$stmt = $conn->prepare("SELECT * FROM notes WHERE user_id = ? AND is_active = 1 ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Notes</h2>
        <div>
            <a href="create.php" class="btn btn-success">+ Add Note</a>
            <a href="../auth/logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="list-group-item mb-2">
                    <h5><?= htmlspecialchars($row['title']) ?></h5>
                    <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    <small class="text-muted">Created: <?= $row['created_at'] ?></small>
                    <div class="mt-2">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this note?')">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>You have no notes yet.</p>
    <?php endif; ?>

</body>
</html>
