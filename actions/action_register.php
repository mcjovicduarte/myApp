<?php
// include database connection
include 'db.php';

// Capture values from form
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate inputs
if (empty($name) || empty($username) || empty($password)) {
    die("All fields are required!");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$date_now = date(format: 'Y-m-d'); // Standard date format

try {
    // Insert user data into the database using a prepared statement
    $sql = "INSERT INTO user (name, username, password, date_joined) VALUES (:name, :username, :password, :date_joined)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':date_joined', $date_now);

    // // Execute the statement
    $stmt->execute();

    // Start User Session [user_id]
    // and Get ID of The Last Inserted Record
    session_start();
    $user_id = $conn->lastInsertId();

    // retrive user data
    $sql2 = "SELECT id, name, username, date_joined FROM user WHERE id = $user_id";
    $result = $conn->prepare($sql2);
    $result->execute();

    // set fetch mode
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // Store result into session variable user
    $_SESSION['user'] = $result->fetch();

    // Redirect the newly registered
    header('Location: ../home.php');
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}