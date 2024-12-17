<?php

$error = ( isset($_GET['error']) ) ? $_GET['error'] : '' ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Style/style.css">
    <title>Log In</title>
</head>
<body>
<style>
    .loginImg {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

    <div class="loginImg">
    <img src="img/OUT 1.png">
    </div>
    <div class="loginTitle">
        <h1 class="text-center">LINKUP</h1>
    </div>
    <div class="loginForm">
        <?php echo "<p class='badge text-bg-danger'>".$error."</p>"; ?>
        <form action="actions/action_login.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" /><br />
            <label>Password:</label>
            <input type="password" name="password" /><br />
            <div class="mt-3">
            <label>Forget password?</label>
            </div>
            <button type="submit" class="">Log In</button>
            <p>
                Dont have an account?
                <a href="index.php" class="text-primary text-decoration-none fw-regular">Sign up</a>
            </p>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>