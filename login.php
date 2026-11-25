<?php
session_start();
include "db.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric   = $_POST['matric'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE matric = ?");
    mysqli_stmt_bind_param($stmt, "s", $matric);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['matric'] = $user['matric'];
        $_SESSION['name']   = $user['name'];
        header("Location: users.php");
        exit();
    } else {
        $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <label>Matric</label>
        <input type="text" name="matric" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p><a href="register.php">Register</a> here if you have not.</p>
</div>
</body>
</html>
