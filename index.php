<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <form action="actions/action_register.php" method="post">
        <label>Name:</label>
        <input type="text" name="name" required /><br />
        <label>Username:</label>
        <input type="text" name="username" required /><br />
        <label>Password:</label>
        <input type="password" name="password" /><br />
        <input type="submit" value="submit" />
    </form>
</body>
</html>