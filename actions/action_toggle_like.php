<?php
session_start();
include 'db.php';

if (empty($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$postId = $_GET['post_id'];
$liked = $_GET['liked'] === 'true' ? 1 : 0;
$userId = $_SESSION['user']['id'];

try {
    if ($liked) {
        $sql = "INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post_id', $postId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    } else {
        $sql = "DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post_id', $postId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
