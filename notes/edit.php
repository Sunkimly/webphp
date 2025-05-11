<?php
require '../includes/auth.php';
require '../includes/config.php';

$user_id = $_SESSION['user_id'];
$msg = '';

// Validate and fetch note
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$note_id = intval($_GET['id']);

// Fetch existing note
$stmt = $conn->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $note_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: index.php");
    exit;
}

$note = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $title, $content, $note_id, $user_id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $msg = "Failed to update note.";
        }
    } else {
        $msg = "Title and content cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2>Edit Note</h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($note['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($note['content']) ?></textarea>
        </div>
        <button class="btn btn-primary">Update Note</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
