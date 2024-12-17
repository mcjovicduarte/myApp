<?php
session_start();
include 'actions/db.php';

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
$posts = [];

try {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $result = $conn->prepare($sql);
    $result->bindParam(':user_id', $user['id']);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $result->fetchAll();

    $profile_sql = "SELECT profile_picture FROM users WHERE id = :user_id";
    $profile_result = $conn->prepare($profile_sql);
    $profile_result->bindParam(':user_id', $user['id']);
    $profile_result->execute();
    $profile_picture = $profile_result->fetch(PDO::FETCH_ASSOC)['profile_picture'];
} catch (PDOException $e) {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Your Posts</title>
    <style>
        .profile-section {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .post-grid img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid nav-title">
            <a class="navbar-brand" style="font-weight: 600; color: #014bad" href="home.php">LinkUP</a>
            <div class="d-flex align-items-center">
                <form action="logout.php" method="post">
                    <button class="btn btn-outline-danger me-2" type="submit" style="border: red; background: red; color:white; text-decoration: none; border-radius: 12px;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <h1 class="text-center mt-1">Your Profile</h1>

    <div class="profile-section">
        <h4 style=" font-size: 26px;"><?php echo htmlspecialchars($user['username']); ?></h4>
    </div>

    <div class="container">
        <?php if (count($posts) > 0) { ?>
            <div class="post-grid">
                <?php foreach ($posts as $post) { ?>
                    <div class="post-item">
                        <?php if (!empty($post['post_image'])) { ?>
                            <img src="<?php echo htmlspecialchars($post['post_image']); ?>" alt="Post Image">
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-center">No posts available.</p>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
