<?php
// start session
session_start();

// include database connection
include 'actions/db.php';

// if session user does not exist
if( empty($_SESSION['user']) ) {
    header('Location: login.php');
    exit();
}

// fetch login user session
$user = $_SESSION['user'];
// print_r($user);

try {
    // Retrieve all posts made by current user from the Posts table.
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $result = $conn->prepare($sql);
    $result->bindParam(':user_id', $user['id']);
    $result->execute();

    // set fetch mode
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // get all posts
    $posts = $result->fetchAll();

    // Retrieve all posts made by current user from the Posts table.
    $timeline_sql = "SELECT user.username, posts.post_text, posts.post_date FROM user JOIN posts ON user.id = posts.user_id";
    $timeline_result = $conn->prepare($timeline_sql);
    $timeline_result->execute();

    // set fetch mode
    $timeline_result->setFetchMode(PDO::FETCH_ASSOC);

    // get all posts
    $time_posts = $timeline_result->fetchAll();

    // echo '<pre>',print_r($time_posts,1),'</pre>';

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome <?php echo ucfirst($user['name']); ?></h1>
    <form action="actions/action_add_post.php" method="post">
        <label>Post:</label>
        <input type="text" name="post" required /><br />
        <input type="submit" value="submit" />
    </form>
    <h5>My posts</h5>
    <ul>
        <?php foreach ($posts as $post) { ?>
            
            <li><?php echo $post['post_text']; ?></li>
            
        <?php } ?>
    </ul>

    <h5>Timeline</h5>
    <ul>
        <?php foreach ($time_posts as $time_post) { ?>
            
            <li><?php echo $time_post['username']; ?>:<br><?php echo $time_post['post_text']; ?></li>
            
        <?php } ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>