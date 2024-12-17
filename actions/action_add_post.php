<?php
session_start();
include 'db.php';

$post = $_POST['post'];
$date_now = date('Y-m-d');
$image = null;

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = "uploads/" . basename($_FILES["image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

$user = $_SESSION['user'];

try {
    $sql = "INSERT INTO posts (user_id, post_text, post_date, post_image) 
            VALUES (:user_id, :post_text, :post_date, :post_image)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':user_id', $user['id']);
    $stmt->bindParam(':post_text', $post);
    $stmt->bindParam(':post_date', $date_now);
    $stmt->bindParam(':post_image', $image);

    $stmt->execute();

    header('Location: ../home.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
