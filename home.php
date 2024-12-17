<?php
session_start();
include 'actions/db.php';

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];

try {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $result = $conn->prepare($sql);
    $result->bindParam(':user_id', $user['id']);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $result->fetchAll();

    $timeline_sql = "SELECT user.username, posts.post_text, posts.post_date, posts.post_image, posts.id AS post_id
                    FROM user
                    JOIN posts ON user.id = posts.user_id
                    ORDER BY posts.post_date DESC";
    $timeline_result = $conn->prepare($timeline_sql);
    $timeline_result->execute();
    $timeline_result->setFetchMode(PDO::FETCH_ASSOC);
    $time_posts = $timeline_result->fetchAll();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function getLikeCount($postId) {
    global $conn;
    $sql = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = :post_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post_id', $postId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['like_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <title>User Profile</title>
    <style>
        @media (max-width: 1125px) {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }
            
            h5 {
                font-size: 26px;
                text-align: center;
                margin-top: 20px;
                color: #014bad;
                font-weight: 700;
            }

            .nav-title a {
                font-size: 26px;
                text-align: center;
                font-weight: 700;
            }

            .form-container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border-bottom: black;
            }

            .timeline-item {
                background-color: #fff;
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .img-fluid {
                max-height: 250px;
                width: 100%;
                object-fit: cover;
                margin-top: 10px;
            }

            .timeline-item strong {
                font-size: 1.1rem;
            }

            .timeline-item small {
                font-size: 0.8rem;
            }

            .like-btn {
                background: none;
                border: none;
                cursor: pointer;
                color: #ff0000;
                font-size: 24px;
            }

            .like-btn:hover {
                color: #cc0000;
            }

            .fa-heart {
                transition: color 0.2s;
            }

            .fa-solid {
                color: #ff0000;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid nav-title">
        <a class="navbar-brand" href="user.php">LinkUP</a>
        <div class="d-flex align-items-center">
            <form action="logout.php" method="post">
                <button class="btn btn-outline-danger me-2" type="submit" style="border: red; background: red; color:white; text-decoration: none; border-radius: 12px;">Logout</button>
            </form>
        </div>
    </div>
</nav>

    <!-- Post Form -->
    <div class="container">
        <div class="form-container bg-light">
            <form action="actions/action_add_post.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control" style="border-radius: 12px; border: solid; border-color: #014bad;" id="post" name="post" placeholder="Write your post here" required>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" style="border-radius: 12px; border: solid; border-color: #014BAD;" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" style="border-radius: 12px; border-color: #014bad;" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <h5>Timeline</h5>
    <ul class="list-unstyled">
        <?php foreach ($time_posts as $time_post) { ?>
            <li class="timeline-item mb-4">
                <div class="d-flex align-items-center">
                    <strong><?php echo htmlspecialchars($time_post['username']); ?>:</strong>
                </div>
                <p><?php echo htmlspecialchars($time_post['post_text']); ?></p>
                <?php if (!empty($time_post['post_image'])) { ?>
                    <div class="mb-2">
                        <img src="<?php echo htmlspecialchars($time_post['post_image']); ?>" alt="Post Image" class="img-fluid rounded">
                    </div>
                <?php } ?>
                <div class="d-flex align-items-center">
                    <button class="like-btn" onclick="toggleLike(<?php echo $time_post['post_id']; ?>)">
                        <i class="fa-regular fa-heart" id="like-icon-<?php echo $time_post['post_id']; ?>"></i>
                    </button>
                    <span id="like-count-<?php echo $time_post['post_id']; ?>"><?php echo getLikeCount($time_post['post_id']); ?></span> Likes
                </div>
                <small class="text-muted"><?php echo htmlspecialchars($time_post['post_date']); ?></small>
            </li>
        <?php } ?>
    </ul>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
