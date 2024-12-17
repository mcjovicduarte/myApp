<?php

// Include the database connection file
include 'db.php';

// capture post data
$username = $_POST['username'];
$password = $_POST['password'];

try {
    // retrieve user
    $sql = "SELECT id, name, username, password FROM user WHERE username = :username";
    $result = $conn->prepare($sql);

    // Bind parameters
    $result->bindParam(':username', $username);

    // Execute the statement
    $result->execute();

    // set fetch mode
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // user result
    $user = $result->fetch();

    // password verification
    if( password_verify($password, $user['password']) ) {

        // Start User Session [user_id]
        session_start();

        // Store result into session variable user
        $_SESSION['user'] = $user;

        // Redirect the newly registered
        header('Location: ../home.php');

    } else {
        
        // Redirect the newly registered
        header('Location: ../login.php?error=invalid credentials');
    }



} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}