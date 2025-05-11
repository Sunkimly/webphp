<?php
require '../includes/auth.php';
require '../includes/config.php';

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $note_id = intval($_GET['id']);

    // Soft delete: set is_active = 0
    $stmt = $conn->prepare("UPDATE notes SET is_active = 0 WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $note_id, $user_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting note.";
    }
} else {
    header("Location: index.php");
    exit;
}
