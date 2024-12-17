<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Style/style.css">
    <title>Registration</title>
</head>
<body>
<style>
body {
    background: linear-gradient(to bottom, rgba(51, 221, 231, 1) 45%, rgba(67, 165, 246, 1) 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.card {
    background-color: #ffffff;
    border: none;
    border-radius: 20px 20px 0px 0px;
    margin-top: 394px;
    height: 500px;
    width: 420px;
    left: -16px;
}
</style>
<div class="container">
    <div class="card p-4 shadow-lg">
        <div class="text-signup">
            <h1 class="text-center mb-4">Sign Up</h1>
        </div>
        <div class="signup-form">
        <form action="actions/action_register.php" method="post">
                <input type="text" id="name" name="name" placeholder="Name" class="form-control" required />
                <input type="text" id="username" name="username" placeholder="Username" class="form-control" required />
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" required />
            <button type="submit">Sign up</button>
            <p>
                Already have an account?
                <a href="login.php" class="text-primary text-decoration-none fw-regular">Sign up</a>
            </p>
        </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>