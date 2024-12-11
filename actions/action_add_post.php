<?php
// include database connection
include 'db.php';

// start session
session_start();

// Capture values from form
$post = $_POST['post'];
$date_now = date(format: 'Y-m-d'); // Standard date format

$user = $_SESSION['user'];

try {
    // Insert user data into the database using a prepared statement
    $sql = "INSERT INTO posts (user_id, post_text, post_date) VALUES (:user_id, :post_text, :post_date)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':user_id', $user['id']);
    $stmt->bindParam(':post_text', $post);
    $stmt->bindParam(':post_date', $date_now);

    // // Execute the statement
    $stmt->execute();
    
    // Redirect the newly registered
    header('Location: ../home.php');
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}