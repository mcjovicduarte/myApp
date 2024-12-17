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

// Check if the username already exists
$sql_check = "SELECT id FROM user WHERE username = :username";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bindParam(':username', $username);
$stmt_check->execute();

// If username already exists
if ($stmt_check->rowCount() > 0) {
    // Redirect back to index.php with an error message
    header("Location: ../index.php?error=account_exists");
    exit; // Stop further execution
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$date_now = date('Y-m-d'); // Standard date format

try {
    // Insert user data into the database using a prepared statement
    $sql = "INSERT INTO user (name, username, password, date_joined) VALUES (:name, :username, :password, :date_joined)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':date_joined', $date_now);

    // Execute the statement
    $stmt->execute();

    // Start User Session [user_id]
    session_start();
    $user_id = $conn->lastInsertId();

    // Retrieve user data
    $sql2 = "SELECT id, name, username, date_joined FROM user WHERE id = :user_id";
    $result = $conn->prepare($sql2);
    $result->bindParam(':user_id', $user_id);
    $result->execute();

    // Set fetch mode
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // Store result into session variable user
    $_SESSION['user'] = $result->fetch();

    // Redirect the newly registered user to the home page
    header('Location: ../home.php');
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
